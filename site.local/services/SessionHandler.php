<?php

namespace App\services;

class SessionHandler 
{
    public $ttl = 1800; // время на 30 минут
    protected $db;
    protected $prefix;

    public function __construct($db, $prefix = 'PHPSESSID:')
    {
        $this->db = $db;
        $this->prefix = $prefix;
    }

    public function close()
    {
        $this->db = null;
        unset($this->db);
    }

    public function read($id)
    {
        $id = $this->prefix . $id;
        $sessionData = $this->db->get($id);
        $this->db->expire($id, $this->ttl);
        return $sessionData;
    }

    public function write($id, $data)
    {
        $id = $this->prefix . $id;
        $this->db->set($id, $data);
        $this->db->expire($id, $this->ttl);
    }

    public function destroy($id)
    {
        $this->db->del($this->prefix . $id);
    }
}
