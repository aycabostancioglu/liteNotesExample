<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        //$var = Note::get(); hepsini getirir
        //$var = Note:: where('veritabaındaki sütun(haystack)','aramakİstediğimDeğer(needle)');
        $user = Auth::user();
        $notlar = Note::where('user_id',$user->id)->latest('updated_at')->paginate(3);  //koleksiyon

        //$notlar = Auth::user()->getNotes;
        return view ('front.notes.index',compact('notlar'));
    }

    public function createPage()
    {
        return view ("front.notes.create");
    }

    public function addNote(Request $request)
    {
        //request
        //dd die and dump dd('ayca')
        //dd($request->all());
        //dd($request['not_baslik']);
        //dd($request->not_baslik);
        //dd(Auth::user());
        //dd(Auth::user()->id);


        $request->validate(
          [
              //'title' => 'Zorunlu minimum 3 karakter'
              'title' => 'required | min:13 | max:20',
              'content' => 'required'
          ]
        ); //true false


        //validasyondan geçtiyse
        $note = new Note();
        $note->user_id =Auth::user()->id;
        $note->title = $request->title;
        $note->content =$request->content;
        $note->save();

        return redirect()->route('notes_index')->with('success','Başarıyla Kaydedildi');
    }

    public function detail1($notID)
    {
        $not = Note::find($notID);

        return view('front.notes.detail1',compact('not'));
    }
}
