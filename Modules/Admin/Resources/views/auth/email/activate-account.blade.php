<html>
	<body>
		<table>
			<tr>
				<td>
					<p>Click <a href="{{route('admin.auth.activate.account' , [ 'user' => $user->id ,'code' => $code])}}">Here</a> To Active Your Account</p>
				</td>
			</tr>
		</table>
	</body>
</html>