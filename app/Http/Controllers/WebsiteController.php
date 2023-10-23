<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\Category;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::all();
        return response()->json($websites);
    }

    public function show(Website $website)
    {
        return response()->json($website);
    }

    // Tüm kullanıcılar için bir website eklemek
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:websites',
            'url' => 'required|url|unique:websites',
        ]);

        // Kullanıcının "create website" iznine sahip olup olmadığını kontrol edin
        if (auth()->user()->can('create website')) {
            $user = auth()->user();
            $website = new Website;
            $website->name = $data['name'];
            $website->url = $data['url'];
            $website->status = 'pending';
            $website->user_id = $user->id;
            $website->save();

            return response()->json($website, 201);
        } else {
            return response()->json(['error' => 'Permission Denied'], 403);
        }
    }


    // Sadece adminler için bir website güncellemek
    public function update(Request $request, Website $website)
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'required|url',
        ]);

        $website->update($data);
        return response()->json($website);
    }

    // Sadece adminler için bir website silmek
    public function destroy(Website $website)
    {
        $website->delete();
        return response()->json(['message' => 'Website deleted.']);
    }

    // Sadece adminler için kategorileri yönetmek
    public function addCategories(Request $request, Website $website)
    {
        // Kategorileri eklemek için gerekli kodu burada ekleyin.
    }

    // Sadece adminler için kategorileri kaldırmak
    public function removeCategory(Website $website, Category $category)
    {
        // Kategorileri kaldırmak için gerekli kodu burada ekleyin.
    }

    // Sadece adminler için website durumunu güncellemek
    public function updateStatus(Request $request, Website $website)
    {
        // Website durumunu güncellemek için gerekli kodu burada ekleyin.
    }

    // Kullanıcılar için kendi websitelerini güncellemek
    public function updateOwn(Request $request, Website $website)
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'required|url',
        ]);

        if ($website->user_id === auth()->id()) {
            $website->update($data);
            return response()->json($website);
        } else {
            return response()->json(['error' => 'Permission Denied Own Website Check.'], 403);
        }
    }

    // Kullanıcılar için kendi websitelerini silmek
    public function deleteOwn(Website $website)
    {
        if ($website->user_id === auth()->id()) {
            $website->delete();
            return response()->json(['message' => 'Website deleted.']);
        } else {
            return response()->json(['error' => 'Permission Denied ID Check.'], 403);
        }
    }
}
