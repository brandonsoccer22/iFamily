<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choir extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','created_by', 'name', 'repeat','note','is_static', 'status','family_id'
    ];

    public static function get(){
        
        $params = [session()->get('user')['family_id']];

        //\Log::info(print_r($params,true));

        $sql = "SELECT choirs.*,u1.name as user_name, u2.name as created_by_name
                FROM choirs, users as u1, users as u2
                WHERE choirs.user_id=u1.id AND choirs.created_by=u2.id AND choirs.status<>'deleted' AND choirs.family_id=?";
       
        $rs = \DB::select($sql, $params);

        return json_decode(json_encode($rs), true);
    }

    public static function getPending(){
        
        $params = [session()->get('user')['family_id']];

        $sql = "SELECT choirs.*,u1.name as user_name, u2.name as created_by_name
                FROM choirs, users as u1, users as u2
                WHERE choirs.user_id=u1.id AND choirs.created_by=u2.id AND choirs.status<>'deleted' AND choirs.status='pending' AND choirs.family_id=?";
       
         $rs = \DB::select($sql,$params);

        return json_decode(json_encode($rs), true);
    }

    public static function getMyChoirs($id){
        $params = [$id];
        //$sql = "SELECT *
         //       FROM choirs
        //        WHERE user_id = ? AND status<>'deleted'";
       	
       	$sql = "SELECT choirs.*,u1.name as user_name, u2.name as created_by_name
                FROM choirs, users as u1, users as u2
                WHERE choirs.user_id=u1.id AND choirs.created_by=u2.id AND choirs.status<>'deleted' AND choirs.user_id = ?";

        $rs = \DB::select($sql, $params);

        return json_decode(json_encode($rs), true);
    }

    public static function getChoir($id){
        $params = [$id];
        $sql = "SELECT *
                FROM choirs
                WHERE id = ?";
       
        $rs = \DB::select($sql, $params);

        return json_decode(json_encode($rs), true)[0];
    }
    
}
