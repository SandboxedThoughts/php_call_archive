import os
import time
from xml.etree import ElementTree as ET
from watchdog.observers import Observer
from watchdog.events import PatternMatchingEventHandler


if __name__ == "__main__":

    # When a new file / directory is created do...
    def on_created(event):
        print(event)
        if event.is_directory == True:
            print("We have a directory!")
        else:
            print("we have a file")




    # Events
    patterns = "*"
    ignore_patterns = ""
    ignore_directories = False
    case_sensitive = False
    recordings_event_handler = PatternMatchingEventHandler(patterns, ignore_patterns, ignore_directories, case_sensitive)
    recordings_event_handler.on_created = on_created 

    # Observer
    path = "./phone_recordings"
    go_recursively = True
    recordings_observer = Observer()
    recordings_observer.schedule(recordings_event_handler, path, recursive=go_recursively)

    recordings_observer.start()
    try:
        while True:
            time.sleep(1)
    except KeyboardInterrupt:
            pass
