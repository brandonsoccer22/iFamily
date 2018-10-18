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
        'user_id','created_by', 'name', 'repeat','note','is_static', 'status'
    ];

    public static function get(){
        
        $sql = "SELECT choirs.*,u1.name as user_name, u2.name as created_by_name
                FROM choirs, users as u1, users as u2
                WHERE choirs.user_id=u1.id AND choirs.created_by=u2.id AND choirs.status<>'deleted'";
       
        $rs = \DB::select($sql);

        return json_decode(json_encode($rs), true);
    }

    public static function getPending(){
        
        $sql = "SELECT choirs.*,u1.name as user_name, u2.name as created_by_name
                FROM choirs, users as u1, users as u2
                WHERE choirs.user_id=u1.id AND choirs.created_by=u2.id AND choirs.status<>'deleted' AND choirs.status='pending'";
       
        $rs = \DB::select($sql);

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
