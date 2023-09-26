<template>
	<section>
		<div>
			<form>
				<input-json-csv @input="handleFileUpload" accept=".json"/>
				<button @click="processFile">Guardar archivo</button>
			</form>
		</div>
	</section>
</template>
<script></script>