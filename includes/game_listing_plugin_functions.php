<?php
//Converts Game Listing Link to Game icon

function game_listing_to_icon($url, $platform){
$returnvalue = "";
if ($url != "")
  {
  switch ($platform)
      {
      //Checks for Windows
      case "Windows":
      case "windows":
      case "Windows 10":
      case "windows 10":
      case "pc":
            $returnvalue .= '<a href="' . $url . '"><i class="fab fa-windows"></i></a>';
            break;

      //Checks for MacOs/Ios
      case "MacOs":
      case "macos":
      case "Macintosh":
      case "macintosh":
      case "Mac":
      case "mac":
      case "ios":
      case "Ios":
      case "ipod":
      case "Ipod":
      case "iphone":
      case "iPhone":
      case "IPhone":
                $returnvalue .= '<a href="' . $url . '"><i class="fab fa-apple"></i></a>';
                break;

      //Checks for Linux/Ubuntu
      case "Linux":
      case "linux":
      case "Ubuntu":
      case "ubuntu":
                $returnvalue .= '<a href="' . $url . '"><i class="fab fa-linux"></i></a>';
                break;

      //Checks for Xbox
      case "Xbox One":
      case "xbox one":
      case "Xbox 360":
      case "xbox 360":
      case "Xbox 1":
      case "Xbone":
      case "Xbone":
      case "XB1":
      case "Xb1":
          $returnvalue .= '<a href="' . $url . '"><i class="fab fa-xbox"></i></a>';
          break;

      //Checks for Playstation
      case "PlayStation":
      case "Playstation":
      case "playstation":
      case "PlayStation 4":
      case "Playstation 4":
      case "playstation 4":
      case "playstation4":
      case "PS4":
      case "ps4":
      case "PlayStation 3":
      case "Playstation 3":
      case "playstation 3":
      case "playstation3":
      case "PS3":
      case "ps3":
      case "PlayStation 2":
      case "Playstation 2":
      case "playstation 2":
      case "playstation2":
      case "PS2":
      case "ps2":
      case "PlayStation Vita":
      case "Playstation Vita":
      case "playstation Vita":
      case "playstationVita":
      case "PSVita":
      case "psVita":
      case "PlayStation vita":
      case "Playstation vita":
      case "playstation vita":
      case "playstationvita":
      case "PSvita":
      case "psvita":
          $returnvalue .= '<a href="' . $url . '"><i class="fab fa-playstation"></i></a>';
          break;

      //Checks for Nintendo Switch
      case "Nintendo Switch":
      case "nintendo switch":
      case "Switch":
      case "switch":
          $returnvalue .= '<a href="' . $url . '"><i class="fab fa-nintendo-switch"></i></a>';
          break;

      //Checks for Android
      case "Android":
      case "android":
      case "AndroidOs":
      case "androidos":
      case "Google Play":
      case "google play":
      case "Play Store":
      case "play store":
          $returnvalue .= '<a href="' . $url . '"><i class="fab fa-google-play"></i></a>';
          break;

      //Default / Edge Case for Platforms without a Font Awesome icon
      default:
          $returnvalue .= '<a href="' . $url . '"><i class="fas fa-gamepad"></i></a>';
          break;
      }
  }
  else {
    $returnvalue .= '';
  }
return $returnvalue;
}
