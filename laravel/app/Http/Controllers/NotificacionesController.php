<?php
    namespace App\Http\Controllers;
    use App\Models\Notificacion;
    use App\Models\CategoriaNotificacion;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class NotificacionesController extends Controller {
        public function crear(Request $request){
            $validated = $request->validate([
                'destinatario_id' => 'required',
                'titulo' => 'required|string',
                'subtitulo' => 'nullable|string',
                'mensaje' => 'required|string',
                'categoria_id' => 'nullable|exists:categorias_notificaciones,id',
            ]);

            $managerId = Auth::id();
            $destinatarios = is_array($validated['destinatario_id']) ? $validated['destinatario_id'] : [$validated['destinatario_id']];
            $notificaciones = [];

            foreach ($destinatarios as $destId) {
                $notificaciones[] = Notificacion::create([
                    'creado_por' => $managerId,
                    'destinatario_id' => $destId,
                    'titulo' => $validated['titulo'],
                    'subtitulo' => $validated['subtitulo'] ?? null,
                    'mensaje' => $validated['mensaje'],
                    'categoria_id' => $validated['categoria_id'] ?? null,
                    'visto' => false,
                ]);
            }

            return response()->json([
                'message' => 'Notificaciones creadas',
                'notificaciones' => $notificaciones
            ], 201);
        }

        public function marcarLeida($id) {
            $user = auth()->user();
            $notificacion = Notificacion::where('id', $id)
                ->where('destinatario_id', $user->id)
                ->firstOrFail();
            $notificacion->visto = true;
            $notificacion->save();
            return response()->json(['message' => 'Notificación marcada como leída']);
        }
    }
