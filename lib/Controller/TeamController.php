<?php
require_once( PATH_CONTROLLER . 'BaseController.php' );
require_once( PATH_MODEL . 'Team.php' );
// TODO 最低限の共通化、全コントローラーで共通部分はBaseControllerにまとめる
// 特別に処理を入れる場合のみ、各Controllerに追記する形で開発する

class TeamController extends BaseController{
	const INPUT_DATA = [
		
	];
	public function __construct(){
	}
	
	public function register(){
		// バリデーション（今のとこ必須チェックだけ）
		if( !self::validation() ){
			self::displayError();
			exit;
		}
		
		// DBに登録
		if( !self::insert() ){
			self::displayError();
			exit;
		}
		
		// メール送信
		if( !self::sendPreRegisterMail() ){
			self::displayError();
			exit;
		}
		
		// 画面表示
		self::displayNormal();
	}
	
	// TODO バリデーション処理の実行、とりあえずは必須チェックだけ
	// あとBaseControllerあたりに共通化して置いとく
	public function validation(){
		$bResult	= true;
		if( !$_REQUEST["mail_address"] ){
			$bResult = false;
		}
		if( !$_REQUEST["team_name"] ){
			$bResult = false;
		}
		if( !$_REQUEST["skype_id"] ){
			$bResult = false;
		}
		
		if( !$_REQUEST["member"] ){
			$bResult = false;
		} else {
			$aMember = $_REQUEST["member"];
			$aMember = array_filter($aMember, "strlen");
			if( count($aMember) == 0 ){
				$bResult = false;
			}
		}
		return $bResult;
	}
	
	public function insert(){
	
		try{
			$mysqli	= new mysqli('localhost', DB_USER, DB_PASSWORD, DB_NAME);
			$mysqli->autocommit(False);
			
			if( $mysqli->connect_error ){
				echo $mysqli->connect_error;
				exit();
			}
			
			// チーム登録
			$sInsertTeamSql		= "INSERT INTO m_team(mail_address,team_name,team_name_kana,team_tag,team_tag_kana,skype_id,comment) VALUE(?,?,?,?,?,?,?)";
			$iTeamId	= 0;
			$mail_address = "";
			
			if($stmt = $mysqli->prepare($sInsertTeamSql)){
				$mail_address	= $_REQUEST["mail_address"];
				$team_name		= $_REQUEST["team_name"];
				$team_name_kana	= $_REQUEST["team_name_kana"];
				$team_tag		= $_REQUEST["team_tag"];
				$team_tag_kana	= $_REQUEST["team_tag_kana"];
				$skype_id		= $_REQUEST["skype_id"];
				$comment		= $_REQUEST["comment"];
				$stmt->bind_param("sssssss",$mail_address,$team_name,$team_name_kana,$team_tag,$team_tag_kana,$skype_id,$comment);
				$stmt->execute();
				
				if( $stmt->error ){
					// TODO エラー処理
					echo $stmt->error;
				}else{
					$iTeamId	= $mysqli->insert_id;
				}
				
				$stmt->close();
			}
			
			$aMember = $_REQUEST["member"];
			$aMember = array_filter($aMember, "strlen");
			// メンバー登録
			$sInsertMemberSql = "INSERT INTO m_member(team_id,summoner_name) VALUE(?,?)";
			foreach($aMember as $sMember){
				if($stmt = $mysqli->prepare($sInsertMemberSql)){
					$stmt->bind_param("is",$iTeamId,$sMember);
					$stmt->execute();
					
					if( $stmt->error ){
						// TODO エラー処理
						echo $stmt->error;
					}else{
						
					}
					
					$stmt->close();
				}
			}
			
			$mysqli->commit();
			
			$mysqli->close();
		} catch (Exception $e) {
			return false;
		}
		return true;
	}
	
	// TODO メールはその内テンプレート読み込んで送信するよう修正、あと共通化
	public function sendPreRegisterMail(){
		try{
			$to			= $_REQUEST["mail_address"];
			$subject	= "LNS仮登録完了";
			$message	= "チーム名：" . $_REQUEST["team_name"] . "（SkypeID:" . $_REQUEST["skype_id"] . "）様\n\n" .
							"League of legends Nippon-no Salaryman 運営でございます。\n" .
							"チーム登録申請ありがとうございます。\n\n" .
							"以下のスカイプIDにコンタクト申請をお願いします。\n\n" .
							"----------------------\n" .
							"SkypeID:live:lns.official1\n" .
							"----------------------\n\n" .
							"スカイプにコンタクト申請を送り、コンタクト申請が認可されましたら登録完了となります。\n\n" .
							"━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n" .
							"※このメールにご返信をいただきましても、送信専用のアドレスのため、\n" .
							"　ご対応致しかねますのでご了承ください。\n" .
							"※本メールに関する一切の内容の無断転載および再配布を禁じます。\n" .
							"※本メールに心当たりのない場合はお手数をお掛けいたしますが\n" .
							"　破棄していただけますようお願いいたします。\n\n".
							"■LNS　公式サイト\n" .
							"　http://lns-lol.com/\n\n" .
							"━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━";
			
			$headers = 'From: no-reply@lns-lol.com' . "\r\n" .
				'Bcc: lns.official1@gmail.com,kate.vf19@gmail.com,ht121200ht@gmail.com,kyon.mg.lol@gmail.com,kurokkingu@gmail.com' . "\r\n" .
				'Reply-To: no-reply@lns-lol.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			
			mail($to, $subject, $message, $headers);
			
		}catch( Exception $e ){
			return false;
		}
		return true;
	}
	
	// 正常系とエラー系とで画面表示はBaseControllerあたりに共通化
	public function displayNormal(){
		$smarty = new Smarty();
		
		$smarty->template_dir = PATH_TMPL;
		$smarty->compile_dir  = PATH_TMPL_C;
		
		$smarty->display('TeamRegister_cmpl.tmpl');
	}
	
	// 正常系とエラー系とで画面表示はBaseControllerあたりに共通化
	public function displayError(){
		$smarty = new Smarty();
		
		$smarty->template_dir = PATH_TMPL;
		$smarty->compile_dir  = PATH_TMPL_C;
		
		$smarty->display('TeamRegister_err.tmpl');
	}
}