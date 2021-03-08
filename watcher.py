import os
import time
from xml.etree import ElementTree as ET
from watchdog.observers import Observer
from watchdog.events import PatternMatchingEventHandler, FileSystemEventHandler


if __name__ == "__main__":

    # When a new file / directory is created do...
    def on_created(event):
        
        print(event)
        if event.is_directory == True:
            print("We have a directory!")
        
        else:
            new_record = {}
            print("we have a file")
            print("the filename is: {}".format(event.src_path.split("\\")[-1]))
            parser = ET.parse(event.src_path)
            for x in parser.getroot():
                new_record[x.tag] = x.text
            for k, v in new_record.items():
                print (k,"-", v)

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
