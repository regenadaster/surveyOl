<?php
  require_once '../_core/_main.inc.php';
  $remoteuser=new userAnswer();
  $remoteuser->setSurveyId(2);
  $tmpcount=$remoteuser->getSubveyAnswerNum();
  echo $tmpcount;
  ?>