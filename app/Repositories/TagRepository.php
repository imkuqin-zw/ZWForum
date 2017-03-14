<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/11
 * Time: 17:32
 */

namespace App\Repositories;

use App\Model\Tag;
use App\Model\Topic;

class TagRepository extends BaseRepository
{
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function getPageOrderByDefault($id, $number = 20,$where = null){
        $tag = $this->getById($id);
        $topics = $tag->topics()
            ->where('is_blocked','no')
            ->orderBy('reply_at','desc')
            ->orderBy('updated_at', 'desc')
            ->whereHas('category',function($q){
                $q->where('is_blocked','no');
            })
            ->paginate($number);
        return $topics;
    }

    public function getPageWithExcellent($id, $number = 20,$where = null){
        $tag = $this->getById($id);
        $topics = $tag->topics()->where('is_blocked','no')
            ->orderBy('updated_at', 'desc')
            ->where('is_excellent', 'yes')
            ->whereHas('category',function($q){
                $q->where('is_blocked','no');
            })
            ->paginate($number);

        return $topics;
    }

    public function getPageOrderByVote($id, $number = 20,$where = null){
        $tag = $this->getById($id);
        $topics = $tag->topics()->orderBy('vote_count', 'desc')
            ->where('is_blocked','no')
            ->whereHas('category',function($q){
                $q->where('is_blocked','no');
            })
            ->paginate($number);

        return $topics;
    }

    public function getPageOrderByNew($id, $number = 20,$where = null){
        $tag = $this->getById($id);
        $topics = $tag->topics()->orderBy('created_at', 'desc')
            ->where('is_blocked','no')
            ->whereHas('category',function($q){
                $q->where('is_blocked','no');
            })
            ->paginate($number);

        return $topics;
    }

    public function getPageWithNoreply($id, $number = 20,$where = null){
        $tag = $this->getById($id);
        $topics = $tag->topics()->orderBy('updated_at', 'desc')
            ->where('is_blocked','no')
            ->whereHas('category',function($q){
                $q->where('is_blocked','no');
            })
            ->where('reply_count', 'no')
            ->paginate($number);

        return $topics;
    }

    /**
     * 按条件获得标签
     *
     * @param $where
     * @return mixed
     */
    public function getTag($where){
        return $this->model->where($where)->get();
    }
}