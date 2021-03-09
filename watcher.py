import os
import time
import mysql.connector
from mysql.connector.errors import IntegrityError as IE
from xml.etree import ElementTree as ET
from watchdog.observers import Observer
from watchdog.events import PatternMatchingEventHandler, FileSystemEventHandler
from helpers import settings


if __name__ == "__main__":

    # When a new file / directory is created do...
    def on_created(event):

        def load_data():
            # get the file path, remove the xml filetype and add wav to the filename in the path. This will give us the location of the recording without having to find it. 
            recording = ("/".join(event.src_path.split("\\"))[0:-3] + "wav")

            filename = event.src_path.split("\\")[-1]
            filetype = filename.split(".")[-1]

            # if the filetype is xml load the data
            if filetype == "xml":
                new_record = {"recording": recording}
                # use the xml file and extract the info
                parser = ET.parse(event.src_path)
                for x in parser.getroot():
                    new_record[x.tag] = x.text
                for k, v in new_record.items():
                    print (k,"-", v)

                sql = mysql.connector.connect(
                    host = settings.RECORDINGS_HOST,
                    user = settings.RECORDINGS_USER,
                    password = settings.RECORDINGS_PASSWORD,
                    database = settings.RECORDINGS_DB,
                )
                
                cursor = sql.cursor()

                # SQL INSERT statement
                stmnt = "INSERT INTO recording_log (recording, recording_tag, recorded_call_id, recorder_cid, recorded_cid, recorder_account_id, recorded_account_id, from_account_id, from_caller_id, to_account_id, to_caller_id, duration, date_created_ts, date_created_secs) VALUES (%(recording)s, %(recording_tag)s, %(recorded_call_id)s, %(recorder_cid)s, %(recorded_cid)s, %(recorder_account_id)s, %(recorded_account_id)s, %(from_account_id)s, %(from_caller_id)s, %(to_account_id)s, %(to_caller_id)s, %(duration)s, %(date_created_ts)s, %(date_created_secs)s)"

                try:
                    cursor.execute(stmnt, new_record)
                except IE:
                    pass

        if event.is_directory == True:
            pass
        
        else:
            # load data from recording
            load_data()


        

    # Events
    recordings_event_handler = FileSystemEventHandler()
    recordings_event_handler.on_created = on_created 

    # Observer
    path = "./phone_recordings"
    go_recursively = True
    recordings_observer = Observer()
    recordings_observer.schedule(recordings_event_handler, path, recursive = go_recursively)

    recordings_observer.start()
    try:
        while True:
            time.sleep(1)
    except KeyboardInterrupt:
            pass

