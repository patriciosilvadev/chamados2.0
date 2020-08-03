<?php

use App\Environment;
use App\Spot;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EnvironmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $environment = Environment::create([
            'name' => 'Cobertura'
        ]);

        // Ambientes da Cobertura
        $environment->spots()->create([
            'name' => 'Cobertura'
        ]);

        $environment = Environment::create([
            'name' => '2º Andar'
        ]);

        // Ambientes do 2º Andar
        $environment->spots()->create([
            'name' => 'Pinacoteca'
        ]);

        $environment = Environment::create([
            'name' => '1º Andar'
        ]);

        // Ambientes do 1º Andar
        Spot::insert([
            [
                'name' => 'Café - Suplicy',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sanitário Feminino',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sanitário Masculino',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Hall - Exposições',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Galeria - Exposições',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Produção',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Arquitetura',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Planejamento Estratégico',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Relações Institucionais',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Diretoria Administrativa',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Reuniões Grande',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Comunicação',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Mediações',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Design',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Curadoria',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Diretoria Artística',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Convivência',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Casa De Máquinas - Ar Condicionado',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Restauro',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Acervo',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala TI',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Contabilidade',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Compras',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Financeiro',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Loja',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala RH',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Da Secretaria',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Eventos',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Reuniões Pequena',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Loja - 1° Andar',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        $environment = Environment::create([
            'name' => 'Térreo'
        ]);

        Spot::insert([
            [
                'name' => 'Bilheteria',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Guarda-Volumes',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Escadas - Acesso Ao 1° Subsolo',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Hall De Entrada',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Vão Livre',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Totens Externos',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        $environment = Environment::create([
            'name' => '1º Subsolo'
        ]);

        Spot::insert([
            [
                'name' => 'Recepção',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Auditório Pequeno',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Auditório Grande',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Cabine De Barramentos',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Corredor Técnico Atrás Dos Auditórios',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'House',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Projeção',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Do QGBT',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Depósito Do Piano',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Palco',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Foyer',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Elevadores',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sanitários',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Doca 1',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Monitoramento',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Copa 1',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Café - Suplicy',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Loja - 1° Ss',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Camarim 37',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Camarim 38',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Camarim 40',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Camarim 43',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Camarim 44',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Camarim 45',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Mezanino',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Galeria De Exposições 1°Ss',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Escadas - Acesso Ao 2°Ss',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'C.A.G - Ar Condicionado',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 150',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Marcenaria',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Doca 2',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Vestiário Masculino',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Vestiário Feminino',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Refeitório / Copa 2',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Escadas - Acesso Ao Restaurante',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Escadas - Acesso Ao 3°Ss',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Corredor - Acesso Grande Auditório E Copa',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Elevadores',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Jardim - 1°Ss',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        $environment = Environment::create([
            'name' => '2º Subsolo'
        ]);

        Spot::insert([
            [
                'name' => 'Galeria De Exposições 2°Ss',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Biblioteca',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Restaurante',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 81 - Casa De Máquinas - Ar Cond.',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Vestiário Masculino - Restaurante',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Vestiário Feminino - Restaurante',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala De Vídeo',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Elevadores',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Hall - Elevadores',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Jardim - 2°Ss',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Escada Externa - 2°Ss',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Estúdio Fotográfico',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 77 - Depósito De Compras',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Alçapão Casa De Máquinas - Ar Condicionado',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sanitário',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Casa De Máquinas - Elevadores',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        $environment = Environment::create([
            'name' => '3º Subsolo'
        ]);

        Spot::insert([
            [
                'name' => 'Acervo - Biblioteca',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Casa De Bombas',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Casa De Máquinas - Torres De Resfriamento',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Elevador Monta-Carga',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Gerador',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Reserva Técnica',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 099',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 100',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 104 - Fototeca',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 105 - Apoio Acervo 1',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 106 - Depósito Da Loja',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 107 - Apoio Acervo 2',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 108 - Casa De Máquinas',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 116',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala 122',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sala Dos Bombeiros',
                'environment_id' => $environment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        $environment = Environment::create([
            'name' => 'Elevador'
        ]);

        $environment->spots()->create([
            'name' => 'Evelador'
        ]);
    }
}
