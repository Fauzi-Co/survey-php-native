<?php
function connect_DB()
{
  $conn = new mysqli('localhost', 'root', '', 'survey');
  return $conn;
}
