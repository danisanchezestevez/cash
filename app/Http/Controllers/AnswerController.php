<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\BrandModel;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    function __construct()
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveForm(Request $request){
        $parameters=$request->toArray();
        if(!$parameters['category_id'] OR !$parameters['_token'])
        {
            return redirect()->route('categories_list')->with('status', 'Ha ocurrido un error');
        }
        $category_id = $parameters['category_id'];
        unset($parameters['category_id']);
        unset($parameters['_token']);
        try {
            $date = new \DateTime();
            $hash = bcrypt($date->getTimestamp());
            foreach ($parameters as $name => $value) {
                $answer = new Answer();
                $answer->category_id = $category_id;
                $answer->question_name = $name;
                $answer->response = $value;
                $answer->hash = $hash;
                $answer->save();
            }
            return redirect()->route('category-detail', ['id' => $category_id])->with('success', 'Mensaje guardado correctamente');
        }
        catch (\Throwable $th){
            return redirect()->route('categories-list')->withErrors(['msg' => 'Ha ocurrido un error '. $th->getMessage()]);
        }
    }

}
