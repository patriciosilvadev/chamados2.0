<?php

namespace App\Http\Controllers;

use App\Support;
use App\Message;
use App\Mail\NewMessage;
use Illuminate\Http\Request;
use App\Events\MessageCreate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, support $support)
    {
        request()->validate(['description' => 'required']);

        $notificacao = $support->notificationTrigger();

        $message = Message::create([
                'description' => request('description'),
                'support_id' => $support->id,
                'user_id' => auth()->user()->cod_user
            ]);

        $message = Message::whereId($message->id)->with(['user'])->first();

        event(new MessageCreate($message));

        if (!$notificacao) {
            try {
                Mail::to($this->sendTo($support))->send(new NewMessage($support));
            } catch (Exception $e) {
                Log::error($e);
            }
        }

        return $message;
    }

    public function sendTo($support)
    {
        if (!$support->fresh()->interacoes->last()->user->suporte()) {
            return $support->departamento->email;
        } elseif ($support->interacoes->last()->user->areaSuporte() != $support->departamento->cod_grupo) {
            return $support->departamento->email;
        } else {
            return $support->user->email;
        }
    }
}
