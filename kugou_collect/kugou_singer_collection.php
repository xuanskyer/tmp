<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 14-7-12
 * Time: 下午11:19
 */

class kugou_singer_collection {
    private $singer_id;         //酷狗歌手ID
    private $singer_name_cn;    //歌手中文名
    private $sinter_name_en;    //歌手英文名
    private $singer_info;       //歌手介绍
    private $singer_avatar_url; //歌手头像路径
    private $singer_cate = array(
        //歌手分类
        '1' => '华语男歌手',
        '2' => '华语女歌手',
        '4' => '华语组合',
        '8' => '日韩男歌手',
        '16' => '日韩女歌手',
        '32' => '日韩组合',
        '64' => '欧美男歌手',
        '128' => '欧美女歌手',
        '256' => '欧美组合',
        '512' => '其他',
    );
    private $singer_country = array(
        '1' => '中国',
        '2' => '日本',
        '3' => '韩国',
        '4' => '欧美',
    );
    //...暂时就这么多吧^-^

    private $php_query;

    public function  __construct(){
        require('phpQuery/phpQuery.php');
        $this->singer_id = 0;
        $this->singer_avatar_url = '';
        $this->singer_info = '';
        $this->singer_name_cn = '';

    }

    /**
     * 从远程URL中获取歌手信息
     * @param string $remote_url
     */
    public function get_singer_from_remote_url($remote_url = ''){
        if($remote_url){
            phpQuery::newDocumentFile($remote_url);
            $this->set_singer_id($remote_url);
            $this->set_singer_name_cn(pq('.top .intro strong')->html());
            $this->set_singer_avatar_url(pq('.top img')->attr('_src'));
            $this->save_avatar_2_file();
            $this->set_singer_info(pq('.top .intro p')->html());
        }
    }

    /**
     * 设置歌手ID
     * @param string $avatar_url
     */
    public function set_singer_id($remote_url = ''){
        if($remote_url){
            $arr_url = explode('/',$remote_url);
            $this->singer_id = array_shift(explode('.',array_pop($arr_url)));
        }
        return $this->singer_id ? true : false;
    }
    /**
     * 设置歌手头像变量
     * @param string $avatar_url
     */
    public function set_singer_avatar_url($avatar_url = ''){
        $this->singer_avatar_url = $avatar_url;
        return $this->singer_avatar_url ? true : false;
    }

    /**
     * 保存歌手头像文件
     */
    public function save_avatar_2_file($save_path = './kugou_singer'){
        if($this->singer_id && $this->singer_avatar_url){
            return file_put_contents("{$save_path}/{$this->singer_id}.jpg",file_get_contents($this->singer_avatar_url));
        }
        return false;
    }

    /**
     * 设置歌手中文名变量
     * @param string $singer_name_cn
     */
    public function set_singer_name_cn($singer_name_cn = ''){
        $this->singer_name_cn = $singer_name_cn;
        return $this->singer_name_cn ? true : false;
    }

    /**
     * 设置歌手简介
     * @param string $singer_info
     */
    public function set_singer_info($singer_info = ''){
        $this->singer_info = $singer_info;
        return $this->singer_info ? true : false;
    }

} 