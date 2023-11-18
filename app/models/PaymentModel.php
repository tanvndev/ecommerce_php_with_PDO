<?php
class PaymentModel extends BaseModel
{
    use SweetAlert;
    public function tableName()
    {
        return 'payment';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }
    function getAllPaymentMethod()
    {
        return $this->db->table('payment_method')->where('status', '=', 1)->get();
    }
    function addNewPayment($data)
    {
        return $this->db->create($this->tableName(), $data);
    }

    function addNewPaymentTransactions($data)
    {
        return $this->db->create('payment_transactions', $data);
    }
}
