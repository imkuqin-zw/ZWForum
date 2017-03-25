<?php
/**
 * Created by PhpStorm.
 * User: Zhangwei
 * Date: 2017/3/24
 * Time: 20:43
 */

namespace App\Repositories;

use App\Model\TopicNotification;
use Carbon\Carbon;

class TopicNotificationRepository extends BaseRepository
{
    /**
     * TopicNotificationRepository constructor.
     *
     * @param TopicNotification $notification
     */
    public function __construct(TopicNotification $notification)
    {
        $this->model = $notification;
    }

    /**
     * 添加话题通知信息到数据库
     *
     * @param $toUsers
     * @param $topic
     */
    public function addNotification($toUsers,$topic){
        foreach ($toUsers as $toUser) {
            $inserts[] =[
                'from_id' => $topic->user_id,
                'topic_id' => $topic->id,
                //'topic_title' => (string)$topic->title,
                //'user_name' => (string)$topic->user->name,
                //'portrait' => $topic->user->portrait_min,
                'to_id' => $toUser->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ];
        }
        $this->model->insert($inserts);
    }

    /**
     * 获得未读通知的数量
     *
     * @param $id
     * @return int
     */
    public function getCount($id){
        return $this->model->where('to_id',$id)->where('read_at',null)->count();
    }

    /**
     * 获取通知信息
     *
     * @param $id
     * @param int $number
     * @return mixed
     */
    public function getNotifications($id,$number = 20)
    {
        $notifications = $this->model->where('to_id',$id)
            ->orderby('read_at')
            ->orderBy('created_at','desc')
            ->paginate($number);
        $this->model->where('to_id',$id)->update(['read_at' => Carbon::now()->toDateTimeString()]);

        return $notifications;
    }
}