<?php

use App\Sector;
use App\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setor/Serviço Engenharia
        $setor = Sector::create([
            'name' => 'Ar Condicionado',
            'support_area_id' => 8,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Medições e ajustes de temperatura e/ou umidade',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Limpeza das grelhas de ar condicionado',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Ajuste nas grelhas de insuflamento de ar',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Regulagem de vazão de água nas torres de água gelada',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Verificação e substituição dos filtros de ar',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Verificação do funcionamento dos equipamentos (fancoils, torres, bombas e chillers)',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Verificação e ajuste de parâmetros no sistema supervisório',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        $setor = Sector::create([
            'name' => 'Elétrica e Iluminação',
            'support_area_id' => 8,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Acompanhamento técnico em eventos (especificar)',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Afinação de iluminação expositiva',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Fornecimento de extensão elétrica',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Inspeção de bombas',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Inspeção de iluminação expositiva e funcional',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Inspeção de quadro elétrico de baixa tensão',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Inspeção do Grupo Moto Gerador',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Inspeção na cabine de entrada de energia',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Instalação de iluminação cênica',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Instalação e ajuste de luminárias',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Montagem de iluminação expositiva',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Passagem de cabos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Programação e operação de iluminação e som de evento',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Reforma em quadro elétrico de baixa tensão',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Revisão em luminárias/refletores incluindo troca de lâmpada e/ou reator',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Operar e gravar luz para eventos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Acompanhamento de medições termográficas nos quadros',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Teste de funcionamento no Grupo Gerador',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Instalação de infraestrutura para novas instalações',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Instalação de aparelhos de aúdio e vídeo',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Acompanhamento de medições da Concessionária de Energia',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        $setor = Sector::create([
            'name' => 'Hidráulica',
            'support_area_id' => 8,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Apoio a equipes externas de execução de obras e serviços (dedetização, chaveiro, limpeza de reservatórios, etc)',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Verificação e operação das bombas do sistema de incêndio e de recalque',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Limpeza da cobertura',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Desentupir vaso sanitário',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Ajuste de vazão de válvula de descarga',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Verificar e reparar vazamentos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Limpeza de ralos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Reparos em tubulações de água',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Manobras em válvulas de fornecimento de água',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Ajustes em válvulas de acionamento de torneiras',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        $setor = Sector::create([
            'name' => 'Manutenção Geral',
            'support_area_id' => 8,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Construção de Forro de Gesso',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Construção de parede em alvenaria',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Construção de parede em drywall',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Reparo em parede de Alvenaria',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Reparo em parede de Drywall',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Ajuste de persianas',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Apoio a equipes externas de execução de obras (especificar)',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Levantamento cadastral de materiais e equipamentos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Manuseio de cortinas da Loja',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Movimentação de materiais pelo museu',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Movimentação de materiais para o anexo',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Recebimento de material',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Regulagem de porta de vidro',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Reparos em piso',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Troca de vidro quebrado',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        $setor = Sector::create([
            'name' => 'Marcenaria',
            'support_area_id' => 8,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Confecção de molduras',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Conserto de móveis',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Conserto de portas',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Confecção de painéis e bases em MDF para exposições',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Confecção de painel de projeção',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Fabricação de móveis',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Montagem de expografia',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Verificação de lotes de madeira junto a fornecedor',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Apoio em eventos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Corte de placas de madeira e acrílico para testes',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        $setor = Sector::create([
            'name' => 'Pintura',
            'support_area_id' => 8,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Apagar pichação nos bancos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Apagar pichação nos pilares',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pintura de andaimes',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Apagar pixacões nas áreas externas do museu',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pintura de móveis e equipamentos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pintura de painéis e bases para exposição',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pintura predial (porta, escada, parede - especificar)',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Retoque de painel expositivo',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        $setor = Sector::create([
            'name' => 'Telefonia',
            'support_area_id' => 8,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Verificar o funcionamento do ramal telefônico',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Instalação de telefone',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $setor = Sector::create([
            'name' => 'Câmera',
            'support_area_id' => 8,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Verificar funcionamento de câmera',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Setor/Serviço TI

        $setor = Sector::create([
            'name' => 'Software',
            'support_area_id' => 7,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Windows',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Apple - MacOSX',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'E-Mail',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Solicitação de Licença de Software',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ERP/Protheus',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'MASP Painel',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sistema de Compras',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sistema de Agendamento',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sistema de Termos',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Sistema de Monitoramento/Aurora',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Microsoft Office',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Solicitação de Desenvolvimento',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ]);

        $setor = Sector::create([
            'name' => 'Hardware',
            'support_area_id' => 7,
            'support_area_type' => 'App\Subdepartment',
            'status' => Carbon::now()
        ]);

        Service::insert([
            [
                'name' => 'Impressora/Multifuncional',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Desktop',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Notebook',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Rede/Internet',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Telefone',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Controle de Acesso/Biometria',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Solicitação de periférico',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Montagem de Totem',
                'sector_id' => $setor->id,
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
