<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/20
 * Time: 1:11
 */

namespace App\Zwforum\Traits;


use App\User;
use App\Zwforum\Markdown\Markdown;

trait ReplyHelper
{
    protected $users = [];
    protected $replyContent;
    protected $replyParsed;


    protected function getReplyUser(){
        preg_match_all("/\@([^\r\n\s]*)/i",$this->replyContent,$tmpArray);
        $usernames = $tmpArray[1];
        return array_unique($usernames);
    }

    protected function replaceUser(){
        foreach ($this->users as $user){
            $search = '@'.$user->name;
            $place ="<a href='".route('user.show', $user->id)."'>".$search."</a>";
            $this->replyParsed = str_replace($search,$place,$this->replyParsed);
        }
    }

    protected function replaceEmoji(){
        $search = "/:([\-+\w]*):/";
        $place = "<img class='emoji' alt='$1' src='".asset('/images/emoji/')."/$1.png' />";
        $this->replyParsed =  preg_replace($search,$place,$this->replyParsed);
    }

    protected function parse($replyContent){
        $markdown = new Markdown();
        $this->replyContent = $markdown->convertMarkdownToHtml($replyContent);
        $this->replyParsed = $this->replyContent;
        $userNames = $this->getReplyUser();

        if(count($userNames) > 0)
            $this->users = User::whereIn('name',$userNames)->get();
        $this->replaceUser();
        $this->replaceEmoji();

        return $this->replyParsed;
    }

}