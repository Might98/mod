<?php

/*
	Ñëèâ by Relevant-Craft.SU

	=========================

	ÑÒÀÍÜ ÕÀÊÅÐÎÌ
	Â ÎÄÈÍ ÊËÈÊ!
*/

	if(!defined('INCLUDE_CHECK')) die("You don't have permissions to run this");
	$skinpath = "http://***.ru/skins/%s.png";///ïóòü ê ñêèíàì
	$cloakpath = "http://***.ru/cloaks/%s.png";///ïóòü ê ïëàùàì
	///Íàñòðîéêè MySQL///
	$mysql = array(
		'server' => 'localhost',//õîñò
		'username' => 'id5644315_adm',//èìÿ ïîëüçîâàòåëÿ
		'password' => 'admin',//ïàðîëü
		'db' => 'id5644315_commit',//èìÿ áàçû äàííûõ
		'port' => '3306',///ïîðò ñîåäèíåíèÿ
		'charset' => 'UTF8'///êîäèðîâêà âûâîäà èç ÁÄ (UTF8 èëè CP1251)
	);
	///Íàñòðîéêà ëàóí÷åðà///
    $prefs = array(
		///íàñòðîéêè///
        "main" => array(
		    "title" => "Kek Launcher", //çàãîëîâîê ëàóí÷åðà
			"ingame" => "Kek | %s",//çàãîëîâîê îêíà èãðû
		    "dir" => ".Kek",//êîðíåâàÿ ïàïêà èãðû
			"site" =>  $_SERVER["SERVER_NAME"]."/mine",//ïàïêà ñ âåá÷àñòüþ
			///Áåç íàäîáíîñòè - íå òðîãàòü///
			"progs" => "goldencreeper,ceerror,pia3333,downforce,cheatengine,procexp,sysinternals,inclasstranslator,wpepro,httpanaly,jdgui,intercepter,batnik,po100b,xvi32,hacked,doos,zhyk,mmoru,HxD,clicker,autoclick,rsclient,easyscript,cffteam",
            "dirs" => "texturepacks,resourcepacks,resources,saves",//ïàïêè, êîòîðûå íå ïðîâåðÿþòñÿ ëàóí÷åðîì
            "excl" => "killaura,kradxn,taehc,ddoss,kodehawa,freecam,speedhack,wallhack,ellian,xrayRender,speedMiner,antiAFK,X-Ray",//×Ñ ÷èòîâ
            "fails" => "classpath,loader,zipfile,jarfile,stringbuffer,file.class,inputstream,class.class,digest,system,runtime",//×Ñ óíèâåðñàëüíûõ îáõîäîâ
            "formats" => "zip,jar,dll,litemod,exe,class,so,dylib,jnilib,bat,pkg",//ïðîâåðÿåìûå äëÿ óäàëåíèÿ òèïû ôàéëîâ
			"locked" => "zip,jar,litemod,exe,class",//òèïû ôàéëîâ, äëÿ êîòîðûõ áëîêèðóåòñÿ çàïèñü
			///Íèæå ìîæíî, âîîáùå, íå òðîãàòü///
			"assets" => "assets",
			"assetmode" => "1",///ðåæèì assets 0-âûêëþ÷èòü óìíóþ çàãðóçêó, 1-ãðóçèòü â ãëàâíîì ïîòîêå, 2 - ãðóçèòü â ôîíå
			"assetver" => "1.2,1.3,1.4,1.5,1.6",///âåðñèè, íà êîòîðûõ íåâîçìîæíà çàãðóçêà assets (1.6 äîáàâëåí, ò.ê. áóäåò þçàòüñÿ assets.pkg)
            "bin" => "bin",
            "config" => "config.cfg",
            "libs" => "libs",
			"libraries" => "libraries",
			"versions" => "versions",
            "natives" => "natives",
            "script" => "launch.php",
        ),
		///ñåðâåðà (íàçâàíèå, ip, port, ïàïêà)
        "servers" => array(
		  'Kek,Kek.38.13.3,25565,kek,1.6.4',
		  'Kek,Kek.38.13.3,25565,kek,1.6.4',
		  'Kek,Kek.38.13.3,25565,kek,1.6.4',
		  'Kek,Kek.38.13.3,25565,kek,1.6.4',
        ),
		///Ðàäèîñòàíöèè (íàçâàíèå, ññûëêà)
        "stations" => array(
            "Åâðîïà +,http://radio.north.kz:8000/europaplus-128",
            "Çàéöåâ FM,http://radio.zaycev.fm:8999/ZaycevFM(128)",
            "Record Club,http://radio.muff.kiev.ua:8000/rrclub",
            "Record DubStep,http://radio.muff.kiev.ua:8000/rrdub",
            "Rock FM,http://mp3.nashe.ru/rock-128.mp3",
        ),
		///Ïàò÷è (íå òðîãàòü)///
		"patches" => array(
			///Ñèñòåìíûå ïàò÷è///
			///'new:>start:>net.minecraft.launchwrapper.LaunchClassLoader:>runTransformers:>null:>{$args[0] = (byte[]) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("transform0", new Class[]{String.class, String.class, byte[].class}).invoke(null, new Object[]{$args[0],$args[1],$args[2]});}:>null',
			'new:>add:>net.minecraft.launchwrapper.LaunchClassLoader:>runTransformers:>null:>{return (byte[]) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("transform", new Class[]{String.class, String.class, byte[].class}).invoke(null, new Object[]{$args[0],$args[1],$args[2]});}:>null',
			'new:>start:>net.minecraft.launchwrapper.Launch:>launch:>null:>{ClassLoader.getSystemClassLoader().loadClass("net.minecraft.Launcher").getDeclaredMethod("getnew",new Class[0]).invoke(null,new Object[0]);}:>null',
			'old:>add:>cpw.mods.fml.relauncher.RelaunchClassLoader:>runTransformers:>null:>{return (byte[]) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("transform", new Class[]{String.class, String.class, byte[].class}).invoke(null, new Object[]{$args[0],$args[0],$args[1]});}:>null',
			///Ïàò÷è çàùèòû///
			'1.4.6,1.4.7:>set:>ayh:>a:>java.lang.String,java.lang.String,java.lang.String:>{String s2 = null; try{s2 = (String) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("auth", new Class[]{String.class, ClassLoader.class}).invoke(null, new Object[]{$args[2],ayh.class.getClassLoader()});} catch (Exception e) {e.printStackTrace();s2 = "Îøèáêà àâòîðèçàöèè!";} return s2;}:>null',
			'1.5.1,1.5.2:>set:>bdk:>a:>java.lang.String,java.lang.String,java.lang.String:>{String s2 = null; try{s2 = (String) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("auth", new Class[]{String.class, ClassLoader.class}).invoke(null, new Object[]{$args[2],bdk.class.getClassLoader()});} catch (Exception e) {e.printStackTrace();s2 = "Îøèáêà àâòîðèçàöèè!";} return s2;}:>null',
			'1.6.1,1.6.2,1.6.4:>set:>bcw:>func_72550_a:>java.lang.String,java.lang.String,java.lang.String:>{String s2 = null; try{s2 = (String) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("auth", new Class[]{String.class, ClassLoader.class}).invoke(null, new Object[]{$args[2],net.minecraft.client.multiplayer.NetClientHandler.class.getClassLoader()});} catch (Exception e) {e.printStackTrace();s2 = "Îøèáêà àâòîðèçàöèè!";} return s2;}:>null',
			'1.6.1,1.6.2,1.6.4,1.7.2,1.7.10,1.8:>start:>org.lwjgl.opengl.Display:>setTitle:>java.lang.String:>{$1=System.getProperty("minecraft.title","Minecraft");}:>null',
			'1.7.1,1.7.2,1.7.4,1.7.5,1.7.9,1.7.10,1.8:>set:>com.mojang.authlib.yggdrasil.YggdrasilMinecraftSessionService:>joinServer:>null:>{try{ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("auth", new Class[]{String.class, ClassLoader.class}).invoke(null, new Object[]{$args[2],com.mojang.authlib.GameProfile.class.getClassLoader()});} catch (Exception e) {e.printStackTrace();} try{String url = (String) ClassLoader.getSystemClassLoader().loadClass("net.k773.Tools").getDeclaredMethod("createurl", new Class[]{String.class}).invoke(null, new Object[]{"j.php?user="+$args[1]}); getAuthenticationService().makeRequest(new java.net.URL(url), null, com.mojang.authlib.yggdrasil.response.Response.class);} catch (Exception e) {e.printStackTrace();}}:>com.mojang.authlib.GameProfile,com.mojang.authlib.yggdrasil.response.Response',
			///Ïàò÷è ñêèíîâ äëÿ 1.6.x/1.7.2///
			//'1.6.1,1.6.2,1.6.4,1.7.2:>set:>net.minecraft.client.entity.AbstractClientPlayer:>func_110300_d:>java.lang.String:>{return ("'.$skinpath.'").replace("%s",(String) $args[0]);}:>null',
			//'1.6.1,1.6.2,1.6.4,1.7.2:>set:>net.minecraft.client.entity.AbstractClientPlayer:>func_110308_e:>java.lang.String:>{return ("'.$cloakpath.'").replace("%s",(String) $args[0]);}:>null',
			///Ïðî÷èå ïàò÷è///
			'1.4.6,1.4.7,1.5.2:>set:>cpw.mods.fml.common.discovery.ModDiscoverer:>findClasspathMods:>cpw.mods.fml.common.ModClassLoader:>{return;}:>method',
			'old:>add:>cpw.mods.fml.relauncher.FMLRelauncher:>showWindow:>null:>{popupWindow.setVisible(false);}:>method',
		),
    );
	///Íàñòðîéêè äèçàéíà///
 $design = array(
        'banners' => array(
            '880,29,204,34,,gray,banners/logo,14,http://,1,',
        ),
        'button' => array(
            'close' => '822,18,11,11,,gray,close,16,',
            'closeingame' => '278,244,18,18,,white,closemin,16',
            'hide' => '802,11,9,18,,gray,hide,16,',
            'hideingame' => '262,244,18,18,,white,hidemin,16',
            'memory' => '651,11,125,23,Âûáîð ÎÇÓ,black,memory,16,',
            'news' => '14,61,276,306,http://site.ru,white,newsbg,0,',
            'online' => '537,76,297,306,http://site.ru,white,newsbg,0,',
            'togame' => '394,454,190,40,Íà÷àòü èãðó,white,button,18,',
        ),
        'checkbox' => array(
            'autoenter' => '194,449,200,17, Àâòîçàõîä íà ñåðâåð,gray,checkbox,14,',
            'conf' => '605,440,200,17, Ñáðîñèòü êîíôèãè,gray,checkbox,14,',
            'fullscreen' => '605,461,200,17, Ïîëíîýêðàííûé ðåæèì,gray,checkbox,14,',
            'play' => '662,550,32,26,,gray,radio,14,',
            'playingame' => '6,263,32,26,,gray,radio,14',
            'savepass' => '194,430,193,17, Çàïîìíèòü ïàðîëü,gray,checkbox,14,',
            'upd' => '194,469,196,17, Ïåðåêà÷àòü êëèåíò,gray,checkbox,14,',
        ),
        'dropdown' => array(
            'servers' => '395,424,190,26,gray,servers,14,1,',
            'stations' => '679,540,137,26,gray,servers,14,1,',
            'stationsingame' => '40,263,148,26,gray,servers,14,1',
        ),
        'elements' => array(
            'assetloader' => '4,4,292,42,292,10,-100,20,',
            'frame' => '850,500,background',
            'loadbar' => '11,377,830,42,364,16,20,65,',
            'title' => '46,7,599,30,16,Kek Launcher by K773,',
        ),
        'slider' => array(
            'volume' => '808,545,88,26,',
            'volumeingame' => '190,263,100,26',
        ),
        'textfield' => array(
            'login' => '7,427,184,29,gray,login,16,30,',
            'pass' => '7,457,184,29,gray,pass,16,30,',
        ),
    );
	
	///Òàáëèöà àâòîðèçàöèè äâèæêà///
	$db_table       	= "dle_users"; //Òàáëèöà ñ ïîëüçîâàòåëÿìè
	$column_User  		= "name"; //Êîëîíêà ñ èìåíàìè ïîëüçîâàòåëåé
	$column_Pass  		= "password"; //Êîëîíêà ñ ïàðîëÿìè ïîëüçîâàòåëåé
	$db_tableOther 		= 'xf_user_authenticate'; //Äîïîëíèòåëüíàÿ òàáëèöà äëÿ XenForo, íå òðîãàéòå
	$column_Salt  	= 'members_pass_salt'; //Íàñòðàèâàåòñÿ äëÿ IPB è vBulletin: , IPB - members_pass_salt, vBulletin - salt
	
	///Òàáëèöà àâòîðèçàöèè ëàóí÷åðà///
	$db_auth       		= "auth"; //Òàáëèöà àâòîðèçàöèè
	$column_id  		= "id";///êîëîíêà id: varchar(32)
	$column_login  		= "login";///êîëîíêà ëîãèíà: varchar(32)
	$column_os  		= "os";///êîëîíêà ëîãèíà: varchar(32)
	$column_arch  		= "arch";///êîëîíêà ëîãèíà: varchar(32)
	$column_salt  		= "salt";///êîëîíêà ñîëü àâòîðèçàöèè òèï: varchar(32)
	$column_Time  		= "timestamp";///êîëîíêà âðåìåíè òèï: varchar(32)
	$column_Group 		= "user_group";///êîëîíêà ãðóïïû dle (äëÿ ïðèâÿçêè) òèï: varchar(32)
	$column_HWID  		= "hwid";////êîëîíêà id æåëåçà òèï: varchar(32)
	$column_HWID2  		= "hwid2";////êîëîíêà id æåëåçà òèï: varchar(32)
	$column_SesId	 	= "session"; ///êîëîíêà ñåññèè òèï: varchar(32)
	$column_Server		= "server"; ///êîëîíêà id ñåðâåðà òèï: varchar(255)
	$column_Priv		= "priv"; ///êîëîíêà ïðèâÿçêè ïî æåëåçó: int(1) 0-íåò,1-äà
	
	///Ðàñøèðåíèÿ ôàéëîâ, ê êîòîðûì ÷óâñòâèòåëüíî îáíîâëåíèå///
	$form				= array('jar','zip','ass','dll','dat','mod','mp3','yml','txt','.so','pkg','lib');
	
	///Èíôîðìàöèÿ î êëàññå çàùèòû///
	$class 				= "ddgdfgggfg.class";///îòíîñèòåëüíûé ïóòü äî êëàññà çàùèòû
	$classname 			= "net.k773.a";
	$method 			= "k";
	
	///Àíòèáðóò///
	$debmode			= array("K773");
	$ac 				= 3;///êîë-âî àêêàóíòîâ íà îäíî æåëåçî
	$stime 				= 10;///âðåìÿ æèçíè ñåññèè â ñåêóíäàõ
	$cache				= 100;///âðåìÿ îáíîâëåíèÿ ìîíèòîðèíãà
	$bancheck			= false;///âêëþ÷åíà ëè ïðîâåðêà íà áàí
	$brute_check 		= true;////âêëþ÷åíà ëè ïðîâåðêà íà áðóò
	$brute_table 		= "brute";
	$ip 				= $_SERVER["REMOTE_ADDR"];///âû÷èñëÿåì ip
	$brute_time 		= 15;////âðåìÿ â ñåêóíäàõ, íà ñêîëüêî áóäåò áëîêèðîâàòüñÿ äîñòóï
	
	$cnews 				= false;
	$cplayers			= true;
	
	include("lib/class.simpleDB.php");
	include("lib/class.simpleMysqli.php");
	$db=new simpleMysqli($mysql);
?>
