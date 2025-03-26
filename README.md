# Tumanyan Library

This project is my first web application, created in 2018 when I was 14 for the library of my school: [**Katarinian-Kananian Armenian School of Esfahan, Iran**](https://evnreport.com/evn-youth-report/the-armenian-footprint-of-isfahan/).

## About

This is a simple web-based library management system. It was designed to help organize and track books and borrowers for the school library. The project uses PHP, MySQL, and Materialize CSS.

## Setup

To start the application:

```bash
docker-compose up
```

The web interface will be available at [http://localhost:8080](http://localhost:8080).

## Known Issue

When accessing the `/katarinian` directory, you may encounter the following error:

```
Fetch Query Error: Table 'slibrary.katarinianlist' doesn't exist
```

Despite my efforts, I couldn't figure out the root cause of this error. The table appears to be created in the initialization SQL, but the error persists.

## License

Do whatever the f\*ck you want with it. [(WTFPL)](./LICENSE)
