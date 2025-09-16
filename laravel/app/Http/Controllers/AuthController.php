<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserPinMail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Login correcto',
            'user' => $user,
            'token' => $token,
        ]);
    }
    public function register(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'hotel_token' => 'required|string|exists:hoteles,token',
            'name' => 'required|string',
            'apellidos' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string',
            'comunidad_autonoma' => 'nullable|string',
            'codigo_postal' => 'nullable|string',
            'rol' => 'sometimes|string',
        ]);

        $hotel = Hotel::where('token', $validated['hotel_token'])->first();
        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }

        $pin = random_int(100000, 999999);

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'hotel_id' => $hotel->id,
            'pin_crear_usuari' => $pin,
            'name' => $validated['name'],
            'apellidos' => $validated['apellidos'],
            'telefono' => $validated['telefono'],
            'direccion' => $validated['direccion'] ?? null,
            'ciudad' => $validated['ciudad'] ?? null,
            'comunidad_autonoma' => $validated['comunidad_autonoma'] ?? null,
            'codigo_postal' => $validated['codigo_postal'] ?? null,
            'rol' => $validated['rol'] ?? 'EMPLEADOS',
        ]);

        Mail::to($user->email)->send(new UserPinMail($pin));

        return response()->json([
            'message' => 'Usuario registrado correctamente. Se ha enviado un email con el PIN.',
            'user' => $user,
        ], 201);
    }

    public function verifyPin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'pin' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        if ($user->pin_crear_usuari !== $validated['pin']) {
            return response()->json(['error' => 'PIN incorrecto'], 401);
        }

        $user->email_verified_at = now();
        $user->pin_crear_usuari = null;
        $user->save();

        return response()->json(['message' => 'PIN verificado correctamente. Email verificado.']);
    }
}
