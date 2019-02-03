<table>
	<thead>
		<tr>
			<th>Question</th>
			<th>Answers</th>	
		</tr>
	</thead>
	<tbody>
		@foreach($questions as $question)
		<tr>
			<td>{{$question['question']}}</td>
			<td>
				<ul>
				@foreach($question['answers'] as $answer)
					<li>{{$answer}}</li>
				@endforeach
				</ul>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>