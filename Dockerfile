FROM python:3.9
COPY . /app
RUN make /app
RUN pip install -r requirements.txt

CMD python /app/main.py