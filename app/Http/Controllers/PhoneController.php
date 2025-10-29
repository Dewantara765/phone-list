<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Phone;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phones = Phone::select("*")
        ->orderBy('updated_at', 'desc')
        ->orderBy('id','desc')->paginate(5)->onEachSide(1);
        return Inertia::render('Home', [
            'phones' => $phones,
            'active' => 'home',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Create', [
            'active' => 'home',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'gambar' => 'nullable|image|mimes:webp,jpeg,jpg,png,gif,svg|max:2048',
            'nama' => 'required',
            'slug' => 'required',
            'brand' => 'required',
            'dimensi' => 'required',
            'berat' => 'nullable',
            'material' => 'required',
            'layar' => 'required',
            'os' => 'required',
            'soc' => 'required',
            'ramstorage' => 'required',
            'kamerautama' => 'required',
            'kameraultrawide' => 'nullable',
            'kameratelephoto' => 'nullable',
            'kameraperiscope' => 'nullable',
            'makro' => 'nullable',
            'depth' => 'nullable',
            'videobelakang' => 'nullable',
            'kameradepan' => 'required',
            'videodepan' => 'nullable',
            'speaker' => 'required',
            'audiojack' => 'required',
            'konektivitas' => 'required',
            'sensor' => 'required',
            'baterai' => 'required',
            'charging' => 'required',
            'harga' => 'nullable',
            ]);//

            if($request->hasFile('gambar')){
                
                $extFile = $request->gambar->getClientOriginalExtension();
                $namaFile = 'gambar-'.time().".".$extFile;
                $path = $request->gambar->move('image',$namaFile);
                $path = str_replace('\\', '/', $path);
        
                $pathBaru = asset('image/'.$namaFile);
                $validateData['gambar'] = $namaFile;
                
            }else{
                $validateData['gambar'] = 'Image-not-found.png';
            }


            Phone::create($validateData);
            return redirect()->route('phones.index')->with('message', 'Phone Data Created Successfully');//
    }

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
         $comments = $phone->comments()->with('user')->latest()->paginate(5)->withQueryString();
         
        return Inertia::render(
            'View',
            [
                'phone' => $phone,
                'phoneId' => $phone->id,
                'likedByUser' => auth()->check() ? $phone->isLikedBy(auth()->user()) : false,
                'likeCountInitial' => $phone->likes()->count(),
                'authUser' => auth()->user(),
                'comments' => $comments,
                'nama' => $phone->nama,
                'active' => 'home',
                
               
                
                
            ]
        );//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phone $phone)
    {
        return Inertia::render(
            'Edit',
            [
                'phone' => $phone,
                'gambar' => $phone->gambar,
            ]
            );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Phone $phone)
    {
        
        $validateData = $request->validate([
            'gambar' => 'nullable|image|mimes:webp,jpeg,jpg,png,gif,svg|max:2048',
            'nama' => 'required',
            'slug' => 'required',
            'brand' => 'required',
            'dimensi' => 'required',
            'berat' => 'nullable',
            'material' => 'required',
            'layar' => 'required',
            'os' => 'required',
            'soc' => 'required',
            'ramstorage' => 'required',
            'kamerautama' => 'required',
            'kameraultrawide' => 'nullable',
            'kameratelephoto' => 'nullable',
            'kameraperiscope' => 'nullable',
            'makro' => 'nullable',
            'depth' => 'nullable',
            'videobelakang' => 'nullable',
            'kameradepan' => 'required',
            'videodepan' => 'nullable',
            'speaker' => 'required',
            'audiojack' => 'required',
            'konektivitas' => 'required',
            'sensor' => 'required',
            'baterai' => 'required',
            'charging' => 'required',
            'harga' => 'nullable',
            ]);//

            if($request->hasFile('gambar')){

                

                    $destination = 'image/'.$phone->gambar;
                    
                    if(File::exists($destination)){

                        File::delete($destination);
                    }
                   
                    
                $extFile = $request->gambar->getClientOriginalExtension();
                // // $namaFile = 'gambar-'.time().".".$extFile;
                $namaFile = 'gambar-'.time().".".$extFile;
               
                $path = $request->gambar->move('image',$namaFile);
                $path = str_replace('\\', '/', $path);
                

                $pathBaru = asset('image/'.$namaFile);
               
                $validateData['gambar'] = $namaFile;

            }else{
                $validateData['gambar'] = $phone->gambar;
               
               
            }
            


              
                    

            Phone::where('id',$phone->id)->update($validateData);
            return redirect()->route('phones.index');//
    }

    public function search(Request $request){
         $q = $request->input('q');
        
        $phones = Phone::when($q, function ($query, $q) {
            $query->where('nama', 'like', '%' . $q . '%')
            ->orderBy('updated_at', 'desc')
            ->orderBy('id','desc');
        })->paginate(5)->onEachSide(1)->withQueryString();

        if(empty($q)){
            $phones = Phone::select("*")
            ->orderBy('updated_at', 'desc')
            ->orderBy('id','desc')->paginate(5)->onEachSide(1);
        }

        return Inertia::render('Home',[
            'phones' => $phones,
            'filters' => $request->only('q'),
            'active' => 'home',
        ]);
    }

   

    public function compare(Request $request){
        $phone1 = $request->phone1;
        $phone2 = $request->phone2;
       

        if(!empty($phone1)){
            $dataphone1 = Phone::where('nama', $phone1)->get();
        }else{
            $dataphone1 = [];
        }
        // dd($dataphone1);

        if(!empty($phone2)){
            $dataphone2 = Phone::where('phones.nama', $phone2)->get();
        }else{
            $dataphone2 = [];
        }

    return Inertia::render('Compare',[
            'phone1' => $phone1,
            'phone2' => $phone2,
            'dataphone1' => $dataphone1,
            'dataphone2' => $dataphone2,
            'active' => 'compare',
        ]);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phone $phone)
    {
        $destination = 'image/'.$phone->gambar;
                    
                    if(File::exists($destination)){

                        File::delete($destination);
                    }
        $phone->delete();
        return redirect()->route('phones.index');//
    }

    public function autocompleteSearch(Request $request)
    {

        $phone1 = $request->phone1;
        $data1 = Phone::where('nama','like','%'.$phone1.'%')->limit(10)->get();

        return response()->json($data1);


    }

   

    // public function like(Phone $phone)
    // {
    //     $phone->likes()->firstOrCreate([
    //         'user_id' => auth()->id(),
    //     ]);

    //     return back(); // atau return inertia response
    // }

    // public function unlike(Phone $phone)
    // {
    //     $phone->likes()->where('user_id', auth()->id())->delete();

    //     return back();
    // }


    
 
}

