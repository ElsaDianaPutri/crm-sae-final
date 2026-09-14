<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RewardController extends Controller
{

    // List reward
    public function index()
    {
        $rewards = Reward::orderBy(
            'created_at',
            'desc'
        )
        ->get();
        return ApiResponse::success(
            'Daftar reward',
            $rewards
        );
    }

    //Membuat nama file aman

    private function generateFileName($file)
    {
        $filename = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );
        $extension = $file->getClientOriginalExtension();
        return str()->slug($filename)
            .'.'.$extension;
    }

    //Tambah reward
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'reward_name'
                    =>'required|string',
                'description'
                    =>'nullable|string',
                'image'
                    =>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'point_required'
                    =>'required|integer|min:1',
                'stock'
                    =>'required|integer|min:0',
                'status'
                    =>'required|in:aktif,nonaktif'
            ]
        );

        if($validator->fails())
        {
            return ApiResponse::error(
                'Validasi gagal',
                422,
                [
                    'errors'=>$validator->errors()
                ]
            );
        }
        $imageUrl = null;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = $this->generateFileName(
                $file
            );

            // cek nama file sudah ada
            if(
                Storage::disk('public')
                ->exists(
                    'rewards/'.$fileName
                )
            )
            {
                return ApiResponse::error(
                    'Nama file gambar sudah digunakan, silakan ubah nama file',
                    422
                );
            }

            $filePath = $file->storeAs(
                'rewards',
                $fileName,
                'public'
            );
            $imageUrl = '/storage/'.$filePath;
        }
        $reward = Reward::create([
            'reward_name'=>$request->reward_name,
            'description'=>$request->description,
            'image_url'=>$imageUrl,
            'point_required'=>$request->point_required,
            'stock'=>$request->stock,
            'status'=>$request->status

        ]);
        return ApiResponse::success(
            'Reward berhasil dibuat',
            $reward,
            201
        );
    }
    
        //Detail reward
    public function show($id)
    {
        $reward = Reward::find($id);
        if(!$reward)
        {
            return ApiResponse::error(
                'Reward tidak ditemukan',
                404
            );
        }
        return ApiResponse::success(
            'Detail reward',
            $reward
        );
    }
    
    //Update reward
    public function update(
        Request $request,
        $id
    )
    {
        $reward = Reward::find($id);
        if(!$reward)
        {
            return ApiResponse::error(
                'Reward tidak ditemukan',
                404
            );
        }

        $validator = Validator::make(
            $request->all(),
            [
                'reward_name'
                    =>'nullable|string',
                'description'
                    =>'nullable|string',
                'image'
                    =>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'point_required'
                    =>'nullable|integer|min:1',
                'stock'
                    =>'nullable|integer|min:0',
                'status'
                    =>'nullable|in:aktif,nonaktif'
            ]
        );

        if($validator->fails())
        {
            return ApiResponse::error(
                'Validasi gagal',
                422,
                [
                    'errors'=>$validator->errors()
                ]
            );
        }

        $imageUrl = $reward->image_url;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = $this->generateFileName(
                $file
            );

            //Cek apakah nama file sudah digunakan oleh reward lain
            $existingReward = Reward::where(
                'image_url',
                '/storage/rewards/'.$fileName
            )
            ->where(
                'id_reward',
                '!=',
                $reward->id_reward
            )
            ->first();
            if($existingReward)
            {
                return ApiResponse::error(
                    'Nama file gambar sudah digunakan oleh reward lain, silakan ubah nama file',
                    422
                );
            }
            //Hapus gambar lama
            if($reward->image_url)
            {
                $oldImage = str_replace(
                    '/storage/',
                    '',
                    $reward->image_url
                );
                Storage::disk('public')
                    ->delete($oldImage);
            }

            // Simpan gambar baru
            $filePath = $file->storeAs(
                'rewards',
                $fileName,
                'public'
            );
            $imageUrl = '/storage/'.$filePath;
        }
        
        $reward->update([
            'reward_name'=>$request->reward_name
                ?? $reward->reward_name,
            'description'=>$request->description
                ?? $reward->description,
            'image_url'=>$imageUrl,
            'point_required'=>$request->point_required
                ?? $reward->point_required,
            'stock'=>$request->stock
                ?? $reward->stock,
            'status'=>$request->status
                ?? $reward->status
        ]);
        return ApiResponse::success(
              'Reward berhasil diperbarui',
            $reward
        );
    }

    // Hapus reward
    public function destroy($id)
    {
        $reward = Reward::find($id);
        if(!$reward)
        {
            return ApiResponse::error(
                'Reward tidak ditemukan',
                404
            );
        }

        try {
            // Hapus file gambar

            if($reward->image_url)
            {
                $image = str_replace(
                    '/storage/',
                    '',
                    $reward->image_url
                );
                Storage::disk('public')
                    ->delete($image);
            }
            $reward->delete();
            return ApiResponse::success(
                'Reward berhasil dihapus'

            );
        }
        catch(\Exception $e)
        {
            return ApiResponse::error(

                'Reward tidak dapat dihapus',

                400

            );


        }

    }

}