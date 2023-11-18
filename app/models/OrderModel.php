<?php
class OrderModel extends BaseModel
{
    use SweetAlert;
    public function tableName()
    {
        return 'orders';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }
    function getAllOrderByUser($user_id)
    {
        return $this->db->table('orders o')->select('o.id, o.order_code, o.status AS order_status, o.total_money, o.order_date, pd.display_name')->join('payment p', 'p.order_id = o.id')->join('payment_method pd', 'pd.id = p.payment_method_id')->where('o.user_id', '=', $user_id)->get();
    }

    function addNewOrder($data)
    {
        return $this->db->create($this->tableName(), $data);
    }

    function addNewOrderItem($data)
    {
        return $this->db->create('order_item', $data);
    }



    function test()
    {
        echo 'ok';
    }
}
