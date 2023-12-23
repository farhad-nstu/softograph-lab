<?php

namespace App\Rules;

use App\Models\CardTask;
use Illuminate\Contracts\Validation\Rule;

class TaskUniqueForCard implements Rule
{
    protected $card_id;
    private $task_id;

    public function __construct($card_id, $task_id=null)
    {
        $this->card_id = $card_id;
        $this->task_id = $task_id;
    }

    public function passes($attribute, $value)
    {
        if($this->task_id){
            $tasks = CardTask::where([
                ['title', $value],
                ['card_id', $this->card_id]
            ])
            ->where('id', '<>', $this->task_id)
            ->get();
        } else{
            $tasks = CardTask::where([
                ['title', $value],
                ['card_id', $this->card_id]
            ])->get();
        }

        if ($tasks->count()) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'Task with this name of this card has already exist!';
    }
}
