<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Document</title>

		<style>
			*{
				box-sizing: border-box;
				margin: 0;
				padding: 0;
			}
			body{
				color: #333;
				font-family: Arial, Helvetica, sans-serif;
				font-size: 16px;
			}
			a, a:hover{
				text-decoration: none
			}

			@media screen and (max-width: 600px){
				img[class="imagen-movil"]{
					height: 50px !important;
					width: 50px !important;
				}
				table[class="table-responsive"]{
					width: 100% !important;
				}
				a[class="link-responsive"]{
					width: 90% !important;
				}
			}
		</style>

	</head>
	<body>

		<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-radius: 3px; padding: 10px 0px 20px">
			<tr>
				<td align="center" style="padding: 20px 20px 30px;">

					<table width="350" cellpadding="0" cellspacing="0" border="0" class="table-responsive" style="background-color: #FFFCF0; border-radius: 3px; -webkit-box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.29); -moz-box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.29); box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.29); margin: 0 auto; padding: 20px 20px 30px;">
						<tr style="padding: 10px 0px 40px;">
							<td align="left">
								<img class="imagen-movil" src="http://charlenetas.com/webAssets/images/mail-campana.png" alt="">
							</td>
							<td align="right">
								<img class="imagen-movil" src="http://charlenetas.com/webAssets/images/logo-charlenetas.png" alt="">
							</td>
						</tr>
						<tr>
							<td colspan=2 style="color: #265D9E; font-size: 24px; padding: 30px 0px;">
								<?= $nombre ?>.
								
								Han respondido una pregunta tuya en charlenetas.
							</td>
						</tr>
						<tr>
							<td align="center" colspan=2 style="padding: 20px 0px 100px;">
								<a href="<?= Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>netas/index?token=<?=$token?>" style="background-color: #498FE1; border-radius: 5px; color: #FFF; display: block; font-size: 20px; height: 43px; line-height: 43px; margin: 0 auto; padding: 0 20px; width: 78%;" class="link-responsive">Ver respuesta</a>
							</td>
						</tr>
						<tr>
							<td colspan=2 align="right" style="color: #999; font-size: 12px; font-style: italic;">
								-charlenetas.com
							</td>
						</tr>
					</table>

				</td>

			</tr>

			<tr>

				<td>
					<table width="350" cellpadding="0" cellspacing="0" border="0" class="table-responsive" style="margin: 0 auto; padding: 20px 0px 0px;">
						<tr>
							<td style="color: #BBB; font-size: 10px; font-style: italic; line-height: 16px; padding: 0px 8px 0px 0px;">
								Este es un correo generado automáticamente, favor de no responderlo. 
								<br>
								Si has recibido este email por error o sin haberlo solicitado, por favor haz caso omiso del mismo.
							</td>
						</tr>
					</table>
				</td>

			</tr>
		</table>
		
	</body>
</html>