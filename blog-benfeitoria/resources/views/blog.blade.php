@extends('layouts.blog')
@section('name')
<example-component>
    <template v-slot:header>Título Teste</template>
    <template v-slot:body>Testando os slots do Vue.js</template></template>
</example-component>
<example-component>
    <template v-slot:header>Título Teste 2</template>
    <template v-slot:body>Testando os slots do Vue.js</template></template>
</example-component>
<example-component>
    <template v-slot:header>Título Teste 3</template>
    <template v-slot:body>Testando os slots do Vue.js</template></template>
</example-component>
@endsection