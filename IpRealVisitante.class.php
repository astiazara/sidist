<?php
class IpRealVisitante
{
    public static function obter()
    {
         $ip = false;
         if(!empty($_SERVER['HTTP_CLIENT_IP']))
         {
              $ip = $_SERVER['HTTP_CLIENT_IP'];
         }
         if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
         {
              $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
              if($ip)
              {
                   array_unshift($ips, $ip);
                   $ip = false;
              }
              for($i = 0; $i < count($ips); $i++)
              {
                   if(!preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i]))
                   {
                        if(version_compare(phpversion(), "5.0.0", ">="))
                        {
                             if(ip2long($ips[$i]) != false)
                             {
                                  $ip = $ips[$i];
                                  break;
                             }
                        }
                        else
                        {
                             if(ip2long($ips[$i]) != - 1)
                             {
                                  $ip = $ips[$i];
                                  break;
                             }
                        }
                   }
              }
         }
         return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }  
}
?>
