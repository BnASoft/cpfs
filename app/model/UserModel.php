<?php
class UserModel extends ModelHelper
{
    protected $id;
    protected $account_type;
    protected $login_id;
    protected $login_pw;
    protected $email;
    protected $nickname;
    protected $hp;
    protected $postzip;
    protected $addr_01;
    protected $addr_02;
    protected $image_name;
    protected $image_url;
    protected $thumb_name;
    protected $thumb_url;
    protected $email_auth_code;
    protected $email_auth_check;
    protected $hp_public_check;
    protected $rate;
    protected $create_date;
    protected $delete_date;
    protected $hidden;
    protected $alarm_rcv_msg;
    protected $alarm_keyword;
    protected $alarm_pick;
    protected $alarm_notice;

    public function __construct($table = 'tbluser')
    {
        parent::__construct($table);
        extract(self::_getQueryVars());

        if ($stx) {
            $this->where .= " AND (login_id LIKE '{$stx}%' ";
            $this->where .= " OR email LIKE '{$stx}%' ";
            $this->where .= " OR nickname LIKE '%{$stx}%' ";
            $this->where .= " OR hp LIKE '%{$stx}%' ";
            $this->where .= " ) ";
        }

        if (empty($sst) || empty($sod)) {
            $this->sst = 'id';
            $this->sod = 'DESC';
        }

        if (!empty($sst) && !empty($sod) && property_exists(get_class($this), $sst)) {
            $this->order = "ORDER BY {$sst} {$sod}";
        } else {
            $this->order = "ORDER BY id DESC";
        }
    }
}
