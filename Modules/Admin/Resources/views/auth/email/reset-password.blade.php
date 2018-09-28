<html>
	<body>
		<table>
			<tr>
				<td>
					<p>Click <a href="{{route('admin.auth.forgot_password.form' , [ 'user' => $user->id ,'code' => $code])}}">Here</a> To Reset Your Password</p>
				</td>
			</tr>
		</table>
	</body>
</html>