<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="margin: 10px 0px;max-width: 100%!important">
  <img src="<?=base_url('assets/images/cranbrook-college-logo2.png')?>" style="float: left;width: 200px !important">
  <h4 style="width: 80%;text-align: center;">Cranbrook College</h4>
  <p style="text-align: center;">180C Cranbrook Road, Ilford, London IG1 4LX</p>
  <p style="text-align: center;">02033711123</p> 
  <hr>
  <h4><?=$title?></h4> 
  <?php if(!empty($history)){?>
  <table style="width: 100% !important;margin-bottom: 20px;border-collapse: collapse;border-spacing: 2px;border: 1px solid #000;">
    <tr>
      <td colspan="4" style="padding: 5px">Payment History</td>
    </tr>
    <tr>
      <td style="border: 1px solid #000;padding:5px">Date</td>
      <td style="border: 1px solid #000;padding:5px">Amount</td>
      <td style="border: 1px solid #000;padding:5px">Recpt. Num</td>
      <td style="border: 1px solid #000;padding:5px">Desc.</td>
    </tr>
    <?php if($fee['status'] == PAID){ ?>
    <tr>
      <td style="border: 1px solid #000;padding:5px"><?=date('d-M-Y h:m')?></td>
      <td style="border: 1px solid #000;padding:5px"><?=$fee['amount']?></td>
      <td style="border: 1px solid #000;padding:5px"><?=$fee['receipt']; ?></td>
      <td style="border: 1px solid #000;padding:5px"><?=$fee['title']; ?></td>
    </tr>
    <?php }?>
  </table> 
  <?php }?>      
  <table style="width: 100% !important;border-spacing: 2px;">
    <tr>
      <td colspan="3" style="font-size: small;"><?='Name: '.$fee['std_name'].' S/O '.$fee['father_name'];?></td>
      <td colspan="3" style="font-size: small;"><?='Roll: '.$fee['roll_no'].' '.$fee['last_date'];?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-size: small;"><?='Receipt Number: '.$fee['receipt']; ?></td>
      <td colspan="3" style="font-size: small;"><?php if($fee['status'] == PAID){
        echo'Paid: Yes';
      }else{
        echo'Paid: No';
      }?></td>
    </tr>
    <tr>
      <?php if(!empty($history)){
        echo'<td colspan="3" style="padding: 10px 0 0;font-size: small;"><b>'.$fee['title'].'</b><br>';
        if($fee['status'] != PAID){
          echo '<p style="font-size: small;color: gray">'.$fee['description'].'</p>';
        }
        echo'</td>';
        echo'<td colspan="3" align="right" style="padding: 5px 0;position: relative">'.$this->data['setting']['currency_symbol'].' '.$fee['amount'].'</td>';
      }else{
        echo'<td colspan="6" align="right" style="padding: 5px 0;">'.$this->data['setting']['currency_symbol'].' '.$fee['amount'].'</td>';
      }?>
      </tr>
    <tr>
      <td colspan="3" style="font-size: small;">Fine</td>
      <td colspan="3" align="right" style="font-size: small;"><?=$this->data['setting']['currency_symbol'].' '.$fee['fine']?></td>
    </tr>
    <tr>
      <td colspan="3" style="font-size: small;">Total</td>
      <td colspan="3" align="right" style="font-size: small;"><b><?=$this->data['setting']['currency_symbol'].' '.$total?></b></td>
    </tr>
  </table>
</div>

</body>
</html>
