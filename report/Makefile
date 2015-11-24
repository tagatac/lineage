title = Lineage
date = $(shell date '+%Y%m%d')
SECTIONS = main

$(date)$(title).pdf : $(SECTIONS:=.tex)
	pdflatex -draftmode -jobname $(date)$(title) main.tex
	pdflatex -jobname $(date)$(title) main.tex

.PHONY : clean

clean :
	rm -vf *$(title).pdf *.aux *.log *.out *.ent *.bbl *.blg
