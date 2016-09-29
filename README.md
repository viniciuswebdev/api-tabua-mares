# api-tabua-mares
API da tábua de marés fornecida pela Marinha do Brasil disponibilizada em http://www.mar.mil.br/dhn/chm/box-previsao-mare/tabuas.

### Parâmetros
Os parâmetros deverão ser fornecidos via GET:
* **localID:** ID do porto desejado
* **mes:** mês das medições desejadas (JAN, FEV, MAR, etc)
* **ano:** ano das medições desejadas (2012, 2013, 2014, etc)

### Retorno
Como retorno, o scraper fornece um JSON no formato:
* ID (int): ID do porto buscado.
* local (string): Nome do porto desejado.
* mes (string): Mês cujas medições foram realizadas.
* ano (int): Ano cujas medições foram realizadas.
* dias (Array): Array de objetos contendo as medições de cada dia. Cada objeto contém:
  * d_sem (String): Dia da semana em que foi feita a medição (SEG, TER, QUA, etc).
  * d_mes (int): Dia do mês em que foi feita a medição.
  * medicoes (Array): array de objetos contendo a medição em um determinado momento. Cada objeto contem:
    * hora (String): Hora em que a medição foi feita no formato HH:MM.
    * altura (String): Altura da maré no momento da medição (em metros).

### Exemplo de Retorno

```json
{
	"ID": 40240,
	"local": "TERMINAL DE BARRA DO RIACHO (ESTADO DO ESPÍRITO SANTO)",
	"mes": "Ago",
	"ano": 2016,
	"dias": [
		{
			"d_sem": "SEG",
			"d_mes": 1,
			"medicoes": [
				{
					"hora": "01:43",
					"altura": "1.3"
				},
				{
					"hora": "08:08",
					"altura": "0.1"
				},
				{
					"hora": "14:28",
					"altura": "1.3"
				},
				{
					"hora": "20:26",
					"altura": "0.3"
				}
			]
		},
		{
			"d_sem": "TER",
			"d_mes": 2,
			"medicoes": [
				{
					"hora": "02:19",
					"altura": "1.4"
				},
				{
					"hora": "08:49",
					"altura": "0.0"
				},
				{
					"hora": "15:04",
					"altura": "1.4"
				},
				{
					"hora": "21:00",
					"altura": "0.3"
				}
			]
		},
		{
			"d_sem": "QUA",
			"d_mes": 3,
			"medicoes": [
				{
					"hora": "02:54",
					"altura": "1.4"
				},
				{
					"hora": "09:23",
					"altura": "0.0"
				},
				{
					"hora": "15:38",
					"altura": "1.4"
				},
				{
					"hora": "21:34",
					"altura": "0.3"
				}
			]
		},
		{
			"d_sem": "QUI",
			"d_mes": 4,
			"medicoes": [
				{
					"hora": "03:26",
					"altura": "1.5"
				},
				{
					"hora": "09:58",
					"altura": "0.0"
				},
				{
					"hora": "16:06",
					"altura": "1.3"
				},
				{
					"hora": "22:04",
					"altura": "0.3"
				}
			]
		},
		{
			"d_sem": "SEX",
			"d_mes": 5,
			"medicoes": [
				{
					"hora": "04:00",
					"altura": "1.5"
				},
				{
					"hora": "10:32",
					"altura": "0.1"
				},
				{
					"hora": "16:38",
					"altura": "1.3"
				},
				{
					"hora": "22:38",
					"altura": "0.3"
				}
			]
		},
		{
			"d_sem": "SÁB",
			"d_mes": 6,
			"medicoes": [
				{
					"hora": "04:34",
					"altura": "1.4"
				},
				{
					"hora": "11:04",
					"altura": "0.1"
				},
				{
					"hora": "17:08",
					"altura": "1.3"
				},
				{
					"hora": "23:09",
					"altura": "0.3"
				}
			]
		},
		{
			"d_sem": "DOM",
			"d_mes": 7,
			"medicoes": [
				{
					"hora": "05:08",
					"altura": "1.4"
				},
				{
					"hora": "11:39",
					"altura": "0.2"
				},
				{
					"hora": "17:43",
					"altura": "1.2"
				},
				{
					"hora": "23:47",
					"altura": "0.4"
				}
			]
		},
	    ...
		{
			"d_sem": "QUA",
			"d_mes": 31,
			"medicoes": [
				{
					"hora": "02:04",
					"altura": "1.4"
				},
				{
					"hora": "08:30",
					"altura": "0.0"
				},
				{
					"hora": "14:45",
					"altura": "1.4"
				},
				{
					"hora": "20:41",
					"altura": "0.3"
				}
			]
		}
	]
}
```