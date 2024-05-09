from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time

# Funció per extreure imatges i textos addicionals
def extreure_contingut(url):
    # Inicialitzar el navegador
    driver = webdriver.Chrome()  # o webdriver.Firefox(), etc. Depèn del teu navegador

    try:
        # Navegar a la URL de la notícia
        driver.get(url)
        time.sleep(2)  # Esperar un moment per assegurar-se que la pàgina està carregada completament

        # Extreure imatges
        imatges = driver.find_elements_by_tag_name('img')
        for img in imatges:
            print("Imatge:", img.get_attribute('src'))

        # Extreure text
        text = driver.find_element_by_tag_name('body').text
        print("Text:", text)

    except Exception as e:
        print("Error:", e)

    finally:
        # Tancar el navegador
        driver.quit()

# Prova de la funció amb una URL de mostra
url_mostra = "URL_DE_LA_NOTÍCIA"
extreure_contingut(url_mostra)