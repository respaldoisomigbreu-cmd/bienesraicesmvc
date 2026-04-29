<fieldset>
    <legend>Informacion General </legend>
    <label for="nombre">Nombre</label>
        <input 
            type="text" 
            id="nombre" 
            name="vendedor[nombre]" 
            placeholder="Vendedor(a) de la propiedad" 
            value="<?php echo s($vendedor->nombre); ?>"
        >    
        
        <label for="apellido">Apellido</label>
        <input 
            type="text" 
            id="apellido" 
            name="vendedor[apellido]" 
            placeholder="Apellido del vendedor(a)" 
            value="<?php echo s($vendedor->apellido); ?>"
        >    
        
        <label for="telefono">Telefono</label>
        <input 
            type="text" 
            id="telefono" 
            name="vendedor[telefono]" 
            placeholder="Telefono del vendedor(a)" 
            value="<?php echo s($vendedor->telefono); ?>"
        >
</fieldset>