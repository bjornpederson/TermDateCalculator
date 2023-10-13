<?php
$startDate;$sb;$sbTitle;
$sd  = $_POST['firstDay'];
$weekTitle = $_POST['term'];
$lenghthofterm = $_POST['numWeeks'];
if (isset($_POST['holidayStart'])&&isset($_POST['holidayToggle'])){
   $sb = $_POST['holidayStart'];
   if (isset($_POST['holidayName'])){
      $sbTitle = $_POST['holidayName'];
   }
}else{
   $sb = NULL;
   $sbTitle = NULL;
}
$turninTime = $_POST['appt'];

if(date('D', strtotime($sd)) === "Mon"||date('D', strtotime($sd)) === "Tue"){
   $startDate = $sd;
}else{
   $startDate = date('m/d/Y', strtotime(''.$sd.'-1 Monday'));
}

$output = '<div class="container-fluid"><div class="row">';
$weeklist = '<div class="col-sm datelist"><h2>Module List</h2><ul>';
$desTooolslist = '<div class="col-sm datelist"><h2>DesignTools List</h2><ul>';
$duelist = '<div class="col"><h2 class="dtlist">Due Dates List</h2>';

$sylTables = '<div class="row"><div class="col"><h2>Syllabus Information</h2></div></div>
<div class="row">';
$divEnd = '</div>';
$weekNum = '<div class="col datelist">
<h3>Syllabus Dates</h3><ul>';
$thursDay ='<div class="col datelist">
<h3>Short Thurs. Date</h3><ul>';
$friDay ='<div class="col datelist">
<h3>Short Fri. Date</h3><ul>';
$sunDay ='<div class="col datelist">
<h3>Short Sun. Date</h3><ul>';
for ($i=1;$i<=$lenghthofterm;$i++){ 
   $weeklist.='<li>';
   $weeklist.=$weekTitle.' '.$i.' : '.date('F j',strtotime($startDate)).' - '.date('F j',strtotime(''.$startDate.'+1 Sunday'));
   $weeklist.='</li>';
   $desTooolslist.='<li>';
   $desTooolslist.=$weekTitle.' '.$i.' : '.date('m/d/Y',strtotime($startDate)).' - '.date('m/d/Y',strtotime(''.$startDate.'+1 Sunday'));
   $desTooolslist.='</li>';

   $duelist.='<div class="row duelist duelistspace">
                  <div class="col">
                        <div class="row">'.$weekTitle.' '.$i.'</div>
                        <div class="row">
                           <div class="col">Thurs - '. date('F j, Y',strtotime(''.$startDate.'next Thursday')).' '.date('g:i a', strtotime($turninTime)).'</div>
                           <div class="col">Fri - '.date('F j, Y',strtotime(''.$startDate.'next Friday')).' '.date('g:i a', strtotime($turninTime)).'</div>
                           <div class="col">Sun - '.date('F j, Y',strtotime(''.$startDate.'next Sunday')).' '.date('g:i a', strtotime($turninTime)).'</div>
                        </div>
                  </div>
               </div>';

   $weekNum.='<li>'.$weekTitle.' '.$i.'<br>'.date('m/d',strtotime($startDate)).'-'.date('m/d',strtotime(''.$startDate.'+1 Sunday')).'</li>';
   $thursDay.= "<li><br>".date('m/d',strtotime(''.$startDate.'next Thursday'))."</li>";
   $friDay.="<li><br>".date('m/d',strtotime(''.$startDate.'next Friday'))."</li>";
   $sunDay.="<li><br>".date('m/d',strtotime(''.$startDate.'next Sunday'))."</li>";
   $startDate = date('m/d/Y', strtotime(''.$startDate.' next Monday'));
   if (!is_null($sb) && isset($_POST['holidayToggle']) && $i<$lenghthofterm ){

      if(date('D', strtotime($sb)) != "Mon"){

         $sb = date('m/d/Y', strtotime(''.$sb.'-1 Monday'));
      }

      if (strtotime($startDate)==strtotime($sb)){

         $weeklist.='<li>';
         $weeklist.=$sbTitle.' : '.date('F j',strtotime($startDate)).' - '.date('F j',strtotime(''.$startDate.'+1 Friday'));
         $weeklist.='</li>';
         $desTooolslist.='<li>';
         $desTooolslist.=$sbTitle.' : '.date('m/d/Y',strtotime($startDate)).' - '.date('m/d/Y',strtotime(''.$startDate.'+1 Sunday'));
         $desTooolslist.='</li>';
         $weekNum.='<li>'.$sbTitle.'</li>';
         $thursDay.='<li>'.$sbTitle.'</li>';
         $friDay.='<li>'.$sbTitle.'</li>';
         $sunDay.='<li>'.$sbTitle.'</li>';
         $startDate = date('m/d/Y', strtotime(''.$startDate.' next Monday'));
      }
   }

}
$weeklist.="</ul>".$divEnd;
$desTooolslist.=$divEnd.''.$divEnd;
$sylTables.=$weekNum.''.$divEnd.''.$thursDay.''.$divEnd.''.$friDay.''.$divEnd.''.$sunDay.''.$divEnd;
$output .= $weeklist.''.$desTooolslist.''.$duelist.''.$divEnd.''.$sylTables.''.$divEnd.''.$divEnd;
echo $output;
exit;
?>