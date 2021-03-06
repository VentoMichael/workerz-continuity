<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Category;
use App\Models\Province;
use Livewire\Component;
use Livewire\WithPagination;

class Ads extends Component
{
    use WithPagination;

    public $search = "";
    public $province=[];
    public $helpText = "";
    public $categoryAds=[];
    protected $queryString = ['search','province','categoryAds'];

    public function render()
    {
        if (strlen($this->search) > 1) {
             sleep(.7);
             $announcements = Announcement::query()
                ->Published()
                ->NoBan()
                 ->join('users', 'users.id', 'announcements.user_id')
                 ->select('users.plan_user_id','announcements.*')
                 ->orderBy('users.plan_user_id','DESC')
                ->orderBy('created_at', 'DESC')
                ->when(
                    $this->categoryAds,
                    function ($query) {
                        return $query->whereHas(
                            'categoryAds',
                            function ($query) {
                                return $query->whereIn('category_id', $this->categoryAds);
                            }
                        );
                    }
                )
                ->when(
                    $this->province,
                    function ($query) {
                        return $query->whereHas(
                            'province',
                            function ($query) {
                                return $query->whereIn('province_id', $this->province);
                            }
                        );
                    })
                ->withLikes()
                ->where('job', 'like',
                    '%'.$this
                        ->search.'%')
                ->paginate(10)
                ->onEachSide(0);
                $this->helpText = '';
        } else {
            if (strlen($this->search) === 1) {
               $this->helpText = 'Il faut 2 caract??res minimum';
            }else{
                $this->helpText = '';
            }
            $announcements = Announcement::Published()
                ->NoBan()
                ->join('users', 'users.id', 'announcements.user_id')
                ->select('users.plan_user_id','announcements.*','like_announcements.*')
                ->orderBy('users.plan_user_id','DESC')
                ->when(
                    $this->categoryAds,
                    function ($query) {
                        return $query->whereHas(
                            'categoryAds',
                            function ($query) {
                                return $query->whereIn('category_id', $this->categoryAds);
                            }
                        );
                    }
                )
                ->when(
                    $this->province,
                    function ($query) {
                        return $query->whereHas(
                            'province',
                            function ($query) {
                                return $query->whereIn('province_id', $this->province);
                            }
                        );
                    })
                ->withLikes()
                ->paginate(10)
                ->onEachSide(0);
        }
        return view('livewire.ads', [
            'newsletterValidated' => request()->session()->get('newsletter'),
            'regions' => Province::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'user' => auth()->user(),
            'announcements' => $announcements,
            'helpText' => $this->helpText,
        ]);
    }
}
