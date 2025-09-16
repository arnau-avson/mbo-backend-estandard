<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function marcarMensajeLeido(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'required|integer|exists:chats,id',
            'mensaje_id' => 'required|integer',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $chat = \App\Models\Chat::find($validated['chat_id']);
        $data_chat = json_decode($chat->data_chat, true);
        $modificado = false;

        foreach ($data_chat as &$mensaje) {
            if ($mensaje['id'] == $validated['mensaje_id']) {
                if (
                    ($mensaje['from'] === 'admin' && $chat->manager_id != $validated['user_id']) ||
                    ($mensaje['from'] === 'empleado' && $chat->empleado_id != $validated['user_id'])
                ) {
                    $mensaje['visto'] = true;
                    $modificado = true;
                }
            }
        }
        unset($mensaje);

        if ($modificado) {
            $chat->data_chat = json_encode($data_chat);
            $chat->save();
            return response()->json(['message' => 'Mensaje marcado como leído.']);
        } else {
            return response()->json(['message' => 'No se pudo marcar como leído (ya estaba leído o no autorizado).'], 400);
        }
    }

    public function crearChat(Request $request)
    {
        $validated = $request->validate([
            'manager_id' => 'required|integer|exists:users,id',
            'empleado_id' => 'required|integer|exists:users,id',
            'mensaje' => 'required|string',
            'from' => 'required|in:admin,empleado',
        ]);

        $chat = new \App\Models\Chat();
        $chat->manager_id = $validated['manager_id'];
        $chat->empleado_id = $validated['empleado_id'];
        $chat->data_chat = json_encode([
            [
                'id' => 1,
                'from' => $validated['from'],
                'msg' => $validated['mensaje'],
                'timestamp' => now()->toDateTimeString(),
                'visto' => false
            ]
        ]);
        $chat->save();

        return response()->json(['message' => 'Chat creado correctamente', 'chat' => $chat], 201);
    }

    public function responderChat(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'required|integer|exists:chats,id',
            'mensaje' => 'required|string',
            'from' => 'required|in:admin,empleado',
        ]);

        $chat = \App\Models\Chat::find($validated['chat_id']);
        $data_chat = json_decode($chat->data_chat, true);

        // Calcular el nuevo id de mensaje
        $nuevo_id = count($data_chat) > 0 ? max(array_column($data_chat, 'id')) + 1 : 1;

        $nuevo_mensaje = [
            'id' => $nuevo_id,
            'from' => $validated['from'],
            'msg' => $validated['mensaje'],
            'timestamp' => now()->toDateTimeString(),
            'visto' => false
        ];
        $data_chat[] = $nuevo_mensaje;
        $chat->data_chat = json_encode($data_chat);
        $chat->save();

        return response()->json(['message' => 'Mensaje añadido', 'nuevo_mensaje' => $nuevo_mensaje], 201);
    }
}
