<?php

namespace Models\Core;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\QueryException as QueryException;

class Contacts extends Model {
    protected $table = "contacts";
    public $timestamp = true;

    public static function get_contacts() {
        $contacts = Contacts::orderBy('created_at', 'desc')->get();
        return $contacts; } // function get_contacts

    public static function add_contact($message) {        
        $item = new Contacts;
        $item->message = $message;
        $item->save();} // function add_contact

    public static function delete_contact($id) {
        Contacts::find($id)->delete();
        } // function delete_contact
}