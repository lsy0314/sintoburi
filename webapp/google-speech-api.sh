#!/usr/bin/env bash

# @title:  A script to transcript from .m4a to a text message with Google Deep-Learning.
# @note    doc/How-to-use-google-speech-api.md
# @site:   https://cloud.google.com/speech-to-text/
# @author: HyeonJun Lim <hjoon0510@gmail.com>
#          Suweon Lim <lsy0314@gmail.com>

# Configuration variables for Google AI speech API
# "message": The request is missing a valid API key.
google_speech=/work/google-speech-api/php-docs-samples/speech/speech.php

# import license key (1년간 공짜로 사용가능합니다. )
export GOOGLE_APPLICATION_CREDENTIALS=/work/sintoburi-79c7917331aa.json

# Check if required commands are prepared
clear
echo -e "Checking required commands..."
which ffmpeg
which php

# Check if an user types argument1 and argument2.
if [[ $1 == "" || $2 == "" ]]; then
    echo -e "\n\n"
    echo -e "Ooops.!!! Run $0 correctly."
    echo -e "rpi3$> $0 {raw|flac} {file_name}.m4a"
    echo -e "\n\n"
    exit 1
fi

# Extract filename and extension in Bash
# https://www.gnu.org/software/bash/manual/html_node/Shell-Parameter-Expansion.html
# https://stackoverflow.com/questions/965053/extract-filename-and-extension-in-bash
FILE="$2"
file_name="${FILE%.*}"
file_ext="${FILE#*.}"

# If you type "flac" as argument 1, use .flac audio format.
# Running sequence: .m4a --> .flac --> korean text
if [[ $1 == "flac" ]]; then
    lang_locale=ko-KR
    sample_rate=44100
    audio_type=FLAC
    if [[ -e $file_name.flac ]];then
        rm -f $file_name.flac
    fi
    echo -e "Running ffmpeg command to convert audio from .m4a to .flac"
    ffmpeg -i $file_name.m4a -ac 1 -af aformat=s16:$sample_rate  $file_name.flac
    echo -e "---------------------------------------------"
    echo -e "Transcribing .flac audio file."
    php $google_speech transcribe  --encoding $audio_type --language-code $lang_locale --sample-rate $sample_rate $file_name.flac > ./$file_name.m4a.log
    cat ./$file_name.log
    rm -f $file_name.flac
fi

# If you type "raw" as argument 1, use .raw audio format.
# Running sequence: .m4a --> .raw --> korean text
if [[ $1 == "raw" ]]; then
    lang_locale=ko-KR
    sample_rate=16000
    audio_type=LINEAR16
    if [[ -e $file_name.raw ]];then
        rm -f $file_name.raw
    fi
    echo -e "Running ffmpeg command to convert audio from .m4a to .raw"
    ffmpeg -y -i $file_name.m4a -acodec pcm_s16le -f s16le -ac 1 -ar $sample_rate $file_name.raw
    echo -e "---------------------------------------------"
    echo -e "Transcribing .raw audio file."
    php $google_speech transcribe  --encoding $audio_type --language-code $lang_locale --sample-rate $sample_rate $file_name.raw > ./$file_name.m4a.txt
    cat ./$file_name.txt
    rm -f $file_name.raw
fi
