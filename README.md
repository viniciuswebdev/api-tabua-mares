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