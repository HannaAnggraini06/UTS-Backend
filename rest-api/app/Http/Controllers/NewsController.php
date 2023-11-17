<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    
    public function index()
    {
        $news = News::all();

        if (!empty($news)) {
            $response = [
                'message' => 'Menampilkan Data Semua Berita',
                'data' => $news,
            ];
            return response()->json($response, 200);
    } else {
        $response = [
            'message' => 'Data tidak ada'
        ];
        return response()->json($response, 200);
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        #validate
        $validateData = $request->validate([
            'title'=> 'required',
            'author'=> 'required',
            'description'=> 'required',
            'content'=> 'required',
            'url'=> 'required',
            'url_image'=> 'required',
            'published_at'=> 'numeric|required',
            'category'=> 'required'
        ]);

        $news = News::create($validateData);



        $response = [
            'message' => 'Berhasil Menambahkan Data',
            'data' => $news,

        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::find($id);

        if($news) {
            $response = [
                'message' => 'Get Detail News',
                'data' => $news,
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Data Not Found'
            ];
            return response()->json($response, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $news = News::find($id);

		if ($news) {
			$response = [
				'message' => 'News is updated',
				'data' => $news->update($request->all())
			];
	
			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data not found'
			];

			return response()->json($response, 404);
		}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);

		if ($news) {
			$response = [
				'message' => 'News is delete',
				'data' => $news->delete()
			];

			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data not found'
			];

			return response()->json($response, 404);
		}
    }

    public function searchByTitle($title)
    {
        $result = News::where('title', 'like', '%' . $title . '%')->get();

        return response()->json(['result' => $result]);
    }
}
