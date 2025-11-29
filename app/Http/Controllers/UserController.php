<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Update status notifikasi email user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroyPenerima($id)
    {
        $user = User::where('id', $id)->where('role', 'penerima')->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Penerima tidak ditemukan.'
            ], 404);
        }

        // Optional: Cek apakah user memiliki riwayat pengajuan/donasi
        // Jika ingin aman, gunakan soft delete atau konfirmasi lebih lanjut
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penerima berhasil dihapus.'
        ]);
    }

    public function destroyDonatur($id)
    {
        $user = User::where('id', $id)->where('role', 'donatur')->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Donatur tidak ditemukan.'
            ], 404);
        }

        // Optional: Cek apakah user memiliki riwayat donasi
        // Jika ingin soft delete, ganti `$user->delete()` dengan `$user->update(['deleted_at' => now()])`
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Donatur berhasil dihapus.'
        ]);
    }

    public function updateNotification(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'notif_email' => 'required|boolean',
        ]);

        $user->update(['notif_email' => $validated['notif_email']]);

        return response()->json([
            'status' => 'success',
            'message' => 'Preferensi notifikasi berhasil disimpan.'
        ]);
    }

    /**
     * Get current email notification preference.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmailNotification(Request $request)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'notif_email' => (bool) $user->notif_email,
        ]);
    }
    /**
     * Update user profile (name, alamat, telepon).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    // Di UserController.php → method updateProfile
    public function updateProfile(Request $request)
    {

        //perbaikanDonatur
        $user = $request->user(); // Menggunakan $request->user() lebih aman daripada Auth::user()

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada (opsional)
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $validated['foto'] = $request->file('foto')->store('profil', 'public');
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.',
        ]);
    }

    /**
     * Change user email (requires current email verification & sends new verification).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeEmail(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'current_email' => [
                'required',
                'email',
                'exists:users,email',
                function ($attribute, $value, $fail) use ($user) {
                    if ($value !== $user->email) {
                        $fail('Email saat ini tidak sesuai.');
                    }
                },
            ],
            'new_email' => 'required|email|unique:users,email',
        ]);

        // Update email hanya jika berbeda
        if ($user->email !== $validated['new_email']) {
            $oldEmail = $user->email; // Simpan email lama
            $user->email = $validated['new_email'];
            $user->email_verified_at = null; // batalkan verifikasi
            $user->save();

            // Kirim ulang email verifikasi — hanya sekali
            $user->sendEmailVerificationNotification();

            // ✅ PERBAIKAN UTAMA: Perbarui session user agar Auth::user() langsung menampilkan email baru
            Auth::login($user); // Login ulang user dengan data terbaru
        }

        return response()->json([
            'success' => true,
            'message' => 'Email berhasil diperbarui. Silakan periksa email Anda untuk verifikasi ulang.',
        ]);
    }

    /**
     * Change user password (logs out other devices on success).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        // Cek apakah user login
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.'
            ], 401);
        }
        $user = $request->user();
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        // Verifikasi password lama
        if (! Hash::check($validated['current_password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kata sandi saat ini salah.',
            ], 422);
        }
        // Update password
        $user->password = Hash::make($validated['new_password']);
        $user->save();
        // ✅ PERBAIKAN UTAMA: Login ulang user dengan password baru
        Auth::login($user); // Login ulang user dengan data terbaru
        return response()->json([
            'success' => true,
            'message' => 'Kata sandi berhasil diperbarui.',
        ]);
    }

    /**
     * Get user profile data for editing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'user' => [
                'name' => $user->name,
                'alamat' => $user->alamat,
                'telepon' => $user->telepon,
                // Jika Anda ingin menampilkan foto profil, aktifkan kode ini
                // 'foto_profil' => $user->foto_profil ? asset('storage/' . $user->foto_profil) : null,
            ]
        ]);
    }
}
