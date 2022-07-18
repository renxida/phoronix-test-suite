cat benches.txt | xargs -I % bash -c "./run_one_and_record.sh %"
