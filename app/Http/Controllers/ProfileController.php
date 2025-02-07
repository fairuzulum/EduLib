<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function edit()
    {
        return view('settings.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input dari user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => ['nullable', 'required_with:password', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi untuk foto profil
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password jika diubah
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Handle foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && Storage::exists('public/profile_photos/' . $user->profile_photo)) {
                Storage::delete('public/profile_photos/' . $user->profile_photo);
            }

            // Simpan foto baru
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = basename($path); // Simpan nama file foto
        }

        // Simpan perubahan ke database
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Hapus foto lama jika ada
        if ($user->profile_photo && Storage::exists('public/profile_photos/' . $user->profile_photo)) {
            Storage::delete('public/profile_photos/' . $user->profile_photo);
        }

        // Simpan foto baru
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = basename($path);
        $user->save();

        return response()->json(['message' => 'Profile photo updated successfully!', 'photo' => asset('storage/profile_photos/' . $user->profile_photo)]);
    }
}
