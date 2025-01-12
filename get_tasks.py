import requests
from bs4 import BeautifulSoup

url = 'http://ege.fipi.ru/bank/questions.php'
params = {
    'proj': 'BA1F39653304A5B041B656915DC36B38',
    'init_filter_themes': '1'
}

response = requests.get(url, params=params)

if response.status_code == 200:
    soup = BeautifulSoup(response.text, 'html.parser')
    qblocks = soup.find_all(class_='qblock')

    for idx, qblock in enumerate(qblocks):
        print(qblock.prettify())  # Печатает отформатированный HTML код блока
        print("\n")
else:
    print(f"Ошибка: {response.status_code}")
