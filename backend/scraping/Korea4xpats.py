from bs4 import BeautifulSoup as bs
import requests

def main():
    url = "www.korea4expats.com/events-in-korea.php"
    r = requests.get(url)
    page = r.text
    soup = bs(page)
    # print(soup)

    conditionList = soup.find(id="") # List of all elements inside the recommends
    print(conditionList)
    # print(soup.find_all('style-scope ytd-section-list-renderer'))

if __name__ == "__main__":
    main()
