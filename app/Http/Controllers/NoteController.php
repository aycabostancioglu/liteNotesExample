<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
              'content' => 'required | min:12'
          ],
          [
              //custom message
              //keyAdı,kuralAdı => 'Mesaj',
              'title.required' => 'Başlık yazmayı unutma',
              'title.min' => 'Lütfen başlığı daha uzun yaz',
              'content.min' => 'İçerik 12 karakter olmalıdır'
          ]
        ); //true false


        //validasyondan geçtiyse
        $note = new Note();
        $note->user_id =Auth::user()->id;
        $note->title = $request->title;
        $note->content =$request->content;
        $note->uuid=Str::uuid();
        $note->save();

        return redirect()->route('notes_index')->with('success','Başarıyla Kaydedildi');

    }

    public function detail1(Note $note)
    {
        //query
        //$not=Note::where('uuid',$notUUID)->first();


        //$not = Note::find($notID);

        if($note->user_id != Auth::user()->id){
            abort('403');
        }

        return view('front.notes.detail1',compact('note'));
    }

    public function update($notID)
    {
        $not = Note::find($notID);
        return view('front.notes.updateNoParam',compact('not'));
    }

    public function edit(Request $request,$notID)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'min:10'
        ]);


        //validasyon
        $not = Note::find($notID);

        $not->title = $request->title;
        $not->content =$request->content;
        $not->save();
        return 'başarılı';
    }

    public function editNoParameter(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'min:10',
            'not_id' => 'required'
        ]);

        $not = Note::find($request->not_id);
        $not->title = $request->title;
        $not->content =$request->content;
        $not->save();


        return redirect()->route('notes_index')->with('success','Güncelleme Başarılı');
    }
}
