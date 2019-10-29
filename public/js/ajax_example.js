<script type="text/javascript">
			$(document).ready(function(){
				$("#login-cedula").blur(function(){
					var $cedula= document.getElementById('login-cedula').value;
					$.ajax({
			        	type: "POST",
			        	url: "login_excepcion",
			        	dataType: "json",
			        	data: {
			        		cedula: $cedula
			        	},
			        	cache: false,
			        	success: function(data)
			        	{
			                var usuarios = '<div style="margin-bottom: 25px" class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span><select class="form-control" id="login-excepcion" name="login-excepcion"><option value="">Seleccionar...</option>';
			                for(datos in data.users){
			                	usuarios += '<option value="'+ data.users[datos].cod +'">'+ data.users[datos].descripcion +'</option>';
			                }
			                usuarios += '</select></div>'
				       		$("#excepcion").html(usuarios);
			       		} 
					});
				});	
			});
		</script>